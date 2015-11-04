#!/usr/bin/env python
# -*- coding: utf8 -*-

import MySQLdb
from contextlib import closing
from glob import glob
import os
import time
import datetime
from email.utils import formatdate

from mutagen.mp3 import MP3
from mutagen.id3 import ID3, TIT2, TPE1, TALB, APIC

import login


FILENAME_PATTERN = '/var/www/Aufnahmen/aufnahme_fertig_*.mp3'
DATE_TIME_FORMAT = '%Y_%m_%d_%H_%M_%S'
PODCAST_IMG_PATH = '/var/www/img/podcast/'


def audio_length(filename):

    length = str(
        datetime.timedelta(seconds=int((MP3(filename)).info.length))
    )
    length_bytes = os.path.getsize(filename)

    return length, length_bytes


def extract_metadata(filename):

    _, _, station_alias, recording_time = filename.split('_', 3)
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


def id3_tag(path, station, station_alias, recording_time):

    podcast_img = PODCAST_IMG_PATH + station_alias + '.jpg'
    if os.path.isfile(podcast_img) is False:
        podcast_img = PODCAST_IMG_PATH + 'default.jpg'

    audio = ID3()
    audio.save(path)
    audio = ID3(path)
    audio.add(TIT2(
            encoding=3, text='{0}, {1:%d.%m.%Y, %H:%M} Uhr'.format(
            station, recording_time))
    )
    audio.add(TPE1(encoding=3, text=station))
    audio.add(TALB(encoding=3, text='{0:%Y-%m-%d}'.format(recording_time)))

    audio.add(APIC(
            encoding = 3,
            mime = 'image/jpeg',
            type = 3,
            desc = u'Cover',
            data = open(podcast_img).read()
            )
    )

    audio.save(v2_version=3)


def write_to_db(connection, recording_time, station,
                new_filename, length, length_bytes):

    rec_date = '{0:%Y-%m-%d}'.format(recording_time)
    rec_time = '{0:%H:%M}'.format(recording_time)
    timestamp = int(recording_time.strftime("%s"))
    pub_date = formatdate(time.time(), True)

    with closing(connection.cursor()) as cursor:

        cursor.execute('INSERT INTO aufnahmen \
        (datum, uhrzeit, sender, datei, zeitstempel, laenge, bytes, pubdate) \
        VALUES (%s,%s,%s,%s,%s,%s,%s,%s)',
                (rec_date, rec_time, station, new_filename,
                 timestamp, length, length_bytes, pub_date))

        connection.commit()


def main():

    with closing(MySQLdb.connect(
            login.DB_HOST, login.DB_USER,
            login.DB_PASSWORD, login.DB_DATABASE)) as connection:

        for path in glob(FILENAME_PATTERN):

            directory = os.path.dirname(path)
            filename, extension = os.path.splitext(os.path.basename(path))

            station_alias, recording_time = extract_metadata(filename)
            station = get_station_name(connection, station_alias)
            new_filename = '{0}_{1:%Y-%m-%d}_{1:%H-%M}{2}'.format(
                    station_alias, recording_time, extension
            )

            id3_tag(path, station, station_alias, recording_time)

            length, length_bytes = audio_length(path)

            write_to_db(
                    connection, recording_time, station,
                    new_filename, length, length_bytes
            )
            os.rename(path, (os.path.join(directory, new_filename)))


if __name__ == '__main__':
    main()
