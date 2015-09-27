#!/usr/bin/env python
# -*- coding: utf8 -*-

import MySQLdb
from glob import glob
import os
import login

def main():

    connection = MySQLdb.connect(login.DB_HOST, login.DB_USER, login.DB_PASSWORD, login.DB_DATABASE)

    for pfad in glob('/var/www/Aufnahmen/aufnahme_fertig_*.mp3'):
        verz = os.path.dirname(pfad)
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
        datei = alias+'_'+jahr+'-'+monat+'-'+tag+'_'+stunde+'-'+minute+'.mp3'

        os.system('id3v2 -t'+'"'+sender+', '+tag+'.'+monat+'.'+jahr+', '+stunde+':'+minute+' Uhr'+'"'+' '+pfad)
        os.rename(pfad,verz+'/'+alias+'_'+jahr+'-'+monat+'-'+tag+'_'+stunde+'-'+minute+'.mp3')

        cursor.execute("INSERT INTO aufnahmen(datum, uhrzeit, sender, datei) VALUES (%s,%s,%s,%s)",(datum, uhrzeit, sender, datei,))
        connection.commit()

    connection.close()

if __name__ == '__main__':
    main()
