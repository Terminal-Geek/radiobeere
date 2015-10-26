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


filename_pattern = '/var/www/Aufnahmen/aufnahme_fertig_*.mp3'
date_time_format = '%Y_%m_%d_%H_%M_%S'

def audio_length(filename):

    length = str(datetime.timedelta(seconds = int((MP3(filename)).info.length)))

    return length


def extract_metadata(filename):

    _, _, station_alias, date_time = filename.split('_',3)    
    date_time = datetime.datetime.strptime(date_time, date_time_format)
    title = '{0}, {1:%d.%m.%Y, %H:%M} Uhr'.format(station_alias, date_time)
    date = '{0:%Y-%m-%d}'.format(date_time)
    time = '{0:%H:%M}'.format(date_time)
    print(title)
    print(date)
    print(time)

    return station_alias, date_time


def get_station_name(connection, station_alias):

    with closing(connection.cursor()) as cursor:
        cursor.execute('SELECT name FROM sender WHERE alias=%s', (station_alias,))
        row = cursor.fetchone()

        if not row:
            raise KeyError('Sender nicht in der Datenbank vorhanden')

        return row[0]


def id3_tag(path, title, artist, album):

    audio = ID3()
    audio.save(path)
    audio = ID3(path)
    audio.add(TIT2(encoding=3, text = u"%s" % title))
    audio.add(TPE1(encoding=3, text = u"%s" % artist))
    audio.add(TALB(encoding=3, text = u"%s" % album))
    audio.save(v2_version=3)


def write_to_db(connection, date, time, station, new_filename, timestamp, length):

    with closing(connection.cursor()) as cursor:

        cursor.execute('INSERT INTO aufnahmen(datum, uhrzeit, sender, datei, zeitstempel, laenge) \
        VALUES (%s,%s,%s,%s,%s,%s)',(date, time, station, new_filename, timestamp, length,))
        connection.commit()


def main():

    with closing \
    (MySQLdb.connect(login.DB_HOST, login.DB_USER, login.DB_PASSWORD, login.DB_DATABASE)) \
    as connection:

        for path in glob(filename_pattern):

            directory = os.path.dirname(path)
            filename, extension = os.path.splitext(os.path.basename(path))

            length = audio_length(path)
            extract_metadata(filename)
##            station = get_station_name(connection, station_alias)

##            date = '{0}-{1}-{2}'.format(year, month, day)
##            time = '{0}:{1}'.format(hour, minutes)
##            title = '{0}, {1}.{2}.{3}, {4} Uhr'.format(station, day, month, year, time)
##
##            new_filename = '{0}_{1}-{2}-{3}_{4}-{5}{6}'.format \
##            (station_alias, year, month, day, hour, minutes, extension)
##
##            id3_tag(path, title, station, date)
##            write_to_db(connection, date, time, station, new_filename, timestamp, length)
##            os.rename(path, (os.path.join(directory, new_filename)))

if __name__ == '__main__':
    main()
