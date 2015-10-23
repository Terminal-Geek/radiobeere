#!/usr/bin/env python
# -*- coding: utf8 -*-

import MySQLdb
import login
from contextlib import closing
from glob import glob
import os
import time
from mutagen.mp3 import MP3
from mutagen.id3 import ID3, TIT2
import datetime


filename_pattern = '/var/www/Aufnahmen/aufnahme_fertig_*.mp3'


def audio_length(filename):

    length = str(datetime.timedelta(seconds = int((MP3(filename)).info.length)))

    return length


def extract_metadata(filename):

    _, _, station_alias, year, month, day, hour, minutes, _ = filename.split('_')
    timestamp = int(time.mktime((int(year), int(month), int(day), int(hour), int(minutes), 0, 0, 0, -1)))

    return station_alias, year, month, day, hour, minutes, timestamp


def get_station_name(connection, station_alias):
    with closing(connection.cursor()) as cursor:
        cursor.execute('SELECT name FROM sender WHERE alias=%s', (station_alias,))
        row = cursor.fetchone()

        if not row:
            raise KeyError('Sender nicht in der Datenbank vorhanden')

        return row[0]


def id3_tag():

    titel = "Noch ein Test"

    audio = ID3()
    audio.save("/var/www/Aufnahmen/aufnahme_fertig_wdr2_2015_10_14_10_20_10.mp3")

    audio = ID3("/var/www/Aufnahmen/aufnahme_fertig_wdr2_2015_10_14_10_20_10.mp3")
    audio.add(TIT2(encoding=3, text = u"%s" % titel))
    audio.save(v2_version=3)

    print(audio.pprint())


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
            station_alias, year, month, day, hour, minutes, timestamp = extract_metadata(filename)
            station = get_station_name(connection, station_alias)
            date = '{0}-{1}-{2}'.format(year, month, day)
            time = '{0}:{1}'.format(hour, minutes)
            title = '{0}, {1}.{2}.{3}, {4} Uhr'.format(station, day, month, year, time)
            new_filename = '{0}_{1}-{2}-{3}_{4}-{5}{6}'.format \
            (station_alias, year, month, day, hour, minutes, extension)

            write_to_db(connection, date, time, station, new_filename, timestamp, length)



def rest():

    connection = MySQLdb.connect(login.DB_HOST, login.DB_USER, login.DB_PASSWORD, login.DB_DATABASE)

    for pfad in glob('/var/www/Aufnahmen/aufnahme_fertig_*.mp3'):
        verzeichnis = os.path.dirname(pfad)
        teil = pfad.split('_')
        alias = teil[2]
        jahr = teil[3]
        monat = teil[4]
        tag = teil[5]
        stunde = teil[6]
        minute = teil[7]
        cursor = connection.cursor()
        cursor.execute("SELECT name FROM sender WHERE alias=%s",(alias,))
        for row in cursor:
            sender = "%s" % row
        datum = jahr+"."+monat+"."+tag 
        uhrzeit = stunde+":"+minute
        zeitstempel = time.mktime((int(jahr), int(monat), int(tag), int(stunde), int(minute), 0, 0, 0, -1))
        datei = alias+'_'+jahr+'-'+monat+'-'+tag+'_'+stunde+'-'+minute+'.mp3'
        laenge = audio_laenge(pfad)

        os.system('id3v2 -t'+'"'+sender+', '+tag+'.'+monat+'.'+jahr+', '+stunde+':'+minute+' Uhr'+'"'+' '+pfad)
        os.rename(pfad,verzeichnis+'/'+alias+'_'+jahr+'-'+monat+'-'+tag+'_'+stunde+'-'+minute+'.mp3')

        cursor.execute("INSERT INTO aufnahmen(datum, uhrzeit, sender, datei, zeitstempel, laenge) VALUES (%s,%s,%s,%s,%s,%s)",(datum, uhrzeit, sender, datei, zeitstempel, laenge,))
        connection.commit()

    connection.close()

if __name__ == '__main__':
    main()
