#!/usr/bin/env python
# -*- coding: utf8 -*-

import MySQLdb
import os
import login

def main():

    connection = MySQLdb.connect(login.DB_HOST, login.DB_USER, login.DB_PASSWORD, login.DB_DATABASE)
    cursor = connection.cursor()
    cursor.execute("SELECT * FROM timer ORDER BY id DESC LIMIT 1")
    DB_EINTRAG = cursor.fetchone()
    ALIAS = DB_EINTRAG[2]
    cursor.execute("SELECT url FROM sender WHERE alias=%s",(ALIAS),)
    DB_ABFRAGE = cursor.fetchone()
    URL = DB_ABFRAGE[0]
    STUNDE = DB_EINTRAG[3]
    MINUTE = DB_EINTRAG[4]
    WOCHENTAGE = DB_EINTRAG[5]
    DAUER = DB_EINTRAG[6]
    TAG = DB_EINTRAG[7]
    MONAT = DB_EINTRAG[8]

    TIMER = MINUTE+" "+STUNDE+" "+TAG+" "+MONAT+" "+WOCHENTAGE+" root /usr/bin/streamripper "+URL+" -d /var/www/Aufnahmen -a aufnahme_aktiv_"+ALIAS+"_\\%d -A -l "+DAUER+" > /dev/null 2>&1 ; rm /var/www/Aufnahmen/*.cue ; rename 's/aufnahme_aktiv_"+ALIAS+"/aufnahme_fertig_"+ALIAS+"/' /var/www/Aufnahmen/*.mp3 ; chmod 777 /var/www/Aufnahmen/aufnahme_fertig_"+ALIAS+"* ; /home/pi/radiobeere/rb-rec-add.py > /dev/null 2>&1"

    cursor.close()
    connection.close()

    CRONTAB = open("/etc/crontab","a+")
    CRONTAB.write(TIMER+'\n')
    CRONTAB.close

if __name__ == '__main__':
    main()
