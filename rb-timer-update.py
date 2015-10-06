#!/usr/bin/env python
# -*- coding: utf8 -*-

import MySQLdb
import os
import time
import login

def delete_outdated_from_db():

    connection = MySQLdb.connect(login.DB_HOST, login.DB_USER, login.DB_PASSWORD, login.DB_DATABASE)
    cursor = connection.cursor()
    ABFRAGE = "SELECT * FROM timer"
    cursor.execute(ABFRAGE)
    ERGEBNIS = cursor.fetchall()
    for TIMER in ERGEBNIS:
        ID = TIMER[0]
        ZEITSTEMPEL = TIMER[9]
        JETZT = time.time()
        if ZEITSTEMPEL != 0 and JETZT > ZEITSTEMPEL:
            LOESCHEN = "DELETE FROM timer WHERE id = %s"
            cursor.execute(LOESCHEN, (ID,))
        connection.commit()
    cursor.close()
    connection.close()

def wipe_cron():
    CRONTAB = open("/etc/crontab","r")
    CRONTAB_NEU = open("/etc/crontab_neu","w")
    SUCHWORT = "streamripper"
    for ZEILE in CRONTAB:
        PRUEFUNG = SUCHWORT in ZEILE
        if PRUEFUNG == False:
            CRONTAB_NEU.write(ZEILE)
    CRONTAB.close()
    CRONTAB_NEU.close()

def add_timer():
    connection = MySQLdb.connect(login.DB_HOST, login.DB_USER, login.DB_PASSWORD, login.DB_DATABASE)
    cursor = connection.cursor()
    ABFRAGE = "SELECT * FROM timer"
    cursor.execute(ABFRAGE)
    ERGEBNIS = cursor.fetchall()
    CRONTAB_NEU = open("/etc/crontab_neu","a+")
    for ZEILE in ERGEBNIS:
        ALIAS = ZEILE[2]
        ABFRAGE2 = "SELECT url FROM sender WHERE alias = %s"
        cursor.execute(ABFRAGE2, (ALIAS,))
        ERGEBNIS2 = cursor.fetchone()
        URL = ERGEBNIS2[0]
        STUNDE = ZEILE[3]
        MINUTE = ZEILE[4]
        WOCHENTAGE = ZEILE[5]
        DAUER = ZEILE[6]
        TAG = ZEILE[7]
        MONAT = ZEILE[8]

        TIMER = MINUTE+" "+STUNDE+" "+TAG+" "+MONAT+" "+WOCHENTAGE+" root /usr/bin/streamripper "+URL+" -d /var/www/Aufnahmen -a aufnahme_aktiv_"+ALIAS+"_\\%d -A -l "+DAUER+" > /dev/null 2>&1 ; rm /var/www/Aufnahmen/*.cue ; rename 's/aufnahme_aktiv_"+ALIAS+"/aufnahme_fertig_"+ALIAS+"/' /var/www/Aufnahmen/*.mp3 ; chmod 777 /var/www/Aufnahmen/aufnahme_fertig_"+ALIAS+"* ; /home/pi/radiobeere/rb-rec-add.py > /dev/null 2>&1"

        CRONTAB_NEU.write(TIMER+'\n')

    CRONTAB_NEU.close
    cursor.close()
    connection.close()

def main():

    delete_outdated_from_db()
    wipe_cron()
    add_timer()
    os.rename("/etc/crontab_neu", "/etc/crontab")

if __name__ == '__main__':
    main()
