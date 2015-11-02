#!/usr/bin/env python
# -*- coding: utf8 -*-

import MySQLdb
from contextlib import closing
from glob import glob
import os

import login


FILENAME_PATTERN = '/var/www/Aufnahmen/*.mp3'
PATH_RECORDINGS = '/var/www/Aufnahmen/'


def delete_files_without_db_entry(cursor):

    for full_path in glob(FILENAME_PATTERN):
        filename = os.path.basename(full_path)
        db_request = 'SELECT COUNT(*) FROM aufnahmen WHERE datei = %s'
        cursor.execute(db_request, (filename,))
        check = cursor.fetchone()[0]
        if check == 0:
            os.remove(full_path)


def delete_db_entries_without_file(connection, cursor):

    cursor.execute('SELECT datei FROM aufnahmen')
    result = cursor.fetchall()
    for filename in result:
        check = os.path.isfile(PATH_RECORDINGS + filename[0])
        if check is False:
            db_request = 'DELETE FROM aufnahmen WHERE datei = %s'
            cursor.execute(db_request, (filename[0],))
            connection.commit()


def main():

    with closing(MySQLdb.connect(
            login.DB_HOST, login.DB_USER,
            login.DB_PASSWORD, login.DB_DATABASE
            )) as connection:

        with closing(connection.cursor()) as cursor:

            delete_files_without_db_entry(cursor)
            delete_db_entries_without_file(connection, cursor)


if __name__ == '__main__':
    main()
