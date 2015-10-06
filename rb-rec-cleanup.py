#!/usr/bin/env python
# -*- coding: utf8 -*-

import MySQLdb
from glob import glob
import os
import login

def main():

    connection = MySQLdb.connect(login.DB_HOST, login.DB_USER, login.DB_PASSWORD, login.DB_DATABASE)
    cursor = connection.cursor()

    for PFAD in glob('/var/www/Aufnahmen/*.mp3'):
        DATEI = os.path.basename(PFAD)
        ABFRAGE = "SELECT COUNT(*) FROM aufnahmen WHERE datei = %s"
        cursor.execute(ABFRAGE, (DATEI,))
        CHECK = cursor.fetchone()[0]
        if CHECK == 0:
            os.remove(PFAD)

    PFAD = '/var/www/Aufnahmen/'
    cursor.execute("SELECT datei FROM aufnahmen")
    ABFRAGE = cursor.fetchall() 
    for DATEI in ABFRAGE:
        CHECK = os.path.isfile(PFAD+DATEI[0])
        if CHECK == False:
            REQUEST = "DELETE FROM aufnahmen WHERE datei = %s"
            cursor.execute(REQUEST, (DATEI[0],))
            connection.commit()

    connection.close()

if __name__ == '__main__':
    main()
