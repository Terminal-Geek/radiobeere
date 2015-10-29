#!/usr/bin/env python
# -*- coding: utf8 -*-

import MySQLdb
import login
from contextlib import closing
from glob import glob
import os
import time
from mutagen.mp3 import MP3
from mutagen.id3 import ID3, TIT2, TPE1, TALB
import datetime


FILENAME_PATTERN = '/var/www/Aufnahmen/aufnahme_fertig_*.mp3'
DATE_TIME_FORMAT = '%Y_%m_%d_%H_%M_%S'

def audio_length(filename):

    length = str(
        datetime.timedelta(seconds = int((MP3(filename)).info.length))
        )

    return length


def extract_metadata(filename):

    _, _, station_alias, recording_time = filename.split('_',3)    
    recording_time = (
            datetime.datetime.strptime(
            recording_time, DATE_TIME_FORMAT)
    )

    return station_alias, recording_time


def get_station_name(connection, station_alias):

    with closing(connection.cursor()) as cursor:
        cursor.execute(
                'SELECT name FROM sender WHERE alias=%s', (
                station_alias,)
        )
        row = cursor.fetchone()

        if not row:
            raise KeyError('Sender nicht in der Datenbank vorhanden')

        return row[0]


def id3_tag(path, station, recording_time):

    audio = ID3()
    audio.save(path)
    audio = ID3(path)
    audio.add(TIT2(
            encoding=3, text = '{0}, {1:%d.%m.%Y, %H:%M} Uhr'.format(
            station, recording_time))
    )
    audio.add(TPE1(encoding=3, text = station))
    audio.add(TALB(encoding=3, text = '{0:%Y-%m-%d}'.format(recording_time)))
    audio.save(v2_version=3)


def write_to_db(connection, recording_time, station, new_filename, length):

    date = '{0:%Y-%m-%d}'.format(recording_time)
    time = '{0:%H:%M}'.format(recording_time)
    timestamp = int(recording_time.strftime("%s"))

    with closing(connection.cursor()) as cursor:

        cursor.execute('INSERT INTO aufnahmen \
        (datum, uhrzeit, sender, datei, zeitstempel, laenge) \
        VALUES (%s,%s,%s,%s,%s,%s)', \
        (date, time, station, new_filename, timestamp, length,))

        connection.commit()


def main():

    with closing (MySQLdb.connect(
            login.DB_HOST, login.DB_USER,
            login.DB_PASSWORD, login.DB_DATABASE)) as connection:

        for path in glob(FILENAME_PATTERN):

            directory = os.path.dirname(path)
            filename, extension = os.path.splitext(os.path.basename(path))

            length = audio_length(path)
            station_alias, recording_time = extract_metadata(filename)
            station = get_station_name(connection, station_alias)
            new_filename = '{0}_{1:%Y-%m-%d}_{1:%H-%M}{2}'.format(
                    station_alias, recording_time, extension
            )

            id3_tag(path, station, recording_time)
            write_to_db(
                    connection, recording_time, station, new_filename, length
            )
            os.rename(path, (os.path.join(directory, new_filename)))

if __name__ == '__main__':
    main()
