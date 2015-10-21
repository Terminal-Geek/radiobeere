#!/usr/bin/env python
# -*- coding: utf8 -*-

import MySQLdb
import login
from glob import glob
import os
import time
from mutagen.mp3 import MP3
import datetime

filename_pattern = "/var/www/Aufnahmen/aufnahme_fertig_*.mp3"
connection = MySQLdb.connect(login.DB_HOST, login.DB_USER, login.DB_PASSWORD, login.DB_DATABASE)


def audio_length(filename):
    length = str(datetime.timedelta(seconds = int((MP3(filename)).info.length)))
    return length


def extract_metadata(filename):
    _, _, station_alias, year, month, day, hour, minutes, _ = filename.split('_')
    timestamp = int(time.mktime((int(year), int(month), int(day), int(hour), int(minutes), 0, 0, 0, -1)))
    return station_alias, year, month, day, hour, minutes, timestamp

def main():
    for path in glob(filename_pattern):
        filename, extension = os.path.splitext(os.path.basename(path))
        station_alias, year, month, day, hour, minutes, timestamp = extract_metadata (filename)
        length = audio_length(path)
        print(filename)
        print(extension)
        print(station_alias)
        print(year)
        print(month)
        print(day)
        print(hour)
        print(minutes)
        print(timestamp)
        print(length)


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
