#!/usr/bin/env python
# -*- coding: utf8 -*-

import MySQLdb
import os

connection = MySQLdb.connect("localhost", "root", "passwort", "radiobeere")
cursor = connection.cursor()
cursor.execute("SELECT * FROM timer ORDER BY id DESC LIMIT 1")
DB_EINTRAG = cursor.fetchone()
print DB_EINTRAG

ALIAS = DB_EINTRAG[2]
print "Alias: "+ALIAS
cursor.execute("SELECT url FROM sender WHERE alias=%s",(ALIAS),)
DB_ABFRAGE = cursor.fetchone()
URL = DB_ABFRAGE[0]
print URL
STUNDE = DB_EINTRAG[3]
print "Stunde: "+STUNDE
MINUTE = DB_EINTRAG[4]
print "Minute: "+MINUTE
WOCHENTAGE = DB_EINTRAG[5]
print "Wochentage: "+WOCHENTAGE
DAUER = DB_EINTRAG[6]
print "Dauer: "+DAUER
TAG = DB_EINTRAG[7]
print "Tag: "+TAG
MONAT = DB_EINTRAG[8]
print "Monat: "+MONAT

TIMER = MINUTE+" "+STUNDE+" "+TAG+" "+MONAT+" "+WOCHENTAGE+" root /usr/bin/streamripper "+URL+" -d /var/www/Aufnahmen -a aufnahme_aktiv_"+ALIAS+"_\\%d -A -l "+DAUER+" > /dev/null 2>&1 ; rm /var/www/Aufnahmen/*.cue ; rename 's/aufnahme_aktiv_"+ALIAS+"/aufnahme_fertig_"+ALIAS+"/' /var/www/Aufnahmen/*.mp3 ; chmod 777 /var/www/Aufnahmen/aufnahme_fertig_"+ALIAS+"* ; /home/pi/radiobeere/rb-rec-add.py > /dev/null 2>&1"
print TIMER

cursor.close()
connection.close()

CRONTAB = open("/etc/crontab","a+")
CRONTAB.write(TIMER+'\n')
CRONTAB.close
