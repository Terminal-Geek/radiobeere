#!/usr/bin/env python
# -*- coding: utf8 -*-

import MySQLdb
from contextlib import closing
import os
import time

import login


PATH_RECORDINGS = '/var/www/Aufnahmen'
MUTE_ERRORS = '> /dev/null 2>&1'


def delete_outdated_from_db(connection, cursor):

    cursor.execute('SELECT * FROM timer')
    result = cursor.fetchall()
    for db_record in result:
        db_record_id = db_record[0]
        timestamp = db_record[9]
        now = time.time()
        if timestamp != 0 and now > timestamp:
            delete_db_entry = 'DELETE FROM timer WHERE id = %s'
            cursor.execute(delete_db_entry, (db_record_id,))
        connection.commit()


def wipe_cron():

    crontab = open('/etc/crontab', 'r')
    crontab_new = open('/etc/crontab_neu', 'w')
    searchstring = 'streamripper'
    for line in crontab:
        find_searchstring = searchstring in line
        if find_searchstring is False:
            crontab_new.write(line)
    crontab.close()
    crontab_new.close()


def create_cron_entry(cursor, db_record):

    cursor.execute('SELECT url FROM sender WHERE alias=%s', (db_record[2]),)
    url = cursor.fetchone()[0]

    cron_entry = [
                db_record[4],
                db_record[3],
                db_record[7],
                db_record[8],
                db_record[5],
                'root /usr/bin/streamripper',
                url,
                '-d',
                PATH_RECORDINGS,
                '-a aufnahme_aktiv_'
                        + db_record[2]
                        + '_\\%d -A -l',
                db_record[6],
                MUTE_ERRORS,
                '; rm',
                PATH_RECORDINGS
                        + '/*.cue ;',
                'rename \'s/aufnahme_aktiv_'
                        + db_record[2]
                        + '/aufnahme_fertig_'
                        + db_record[2]
                        + '/\'',
                PATH_RECORDINGS
                        + '/*.mp3 ;',
                'chmod 777',
                PATH_RECORDINGS
                        + '/aufnahme_fertig_'
                        + db_record[2]
                        + '* ;',
                '/home/pi/radiobeere/rb-rec-add.py',
                MUTE_ERRORS,
                '; /home/pi/radiobeere/podcast.py',
                db_record[2],
                MUTE_ERRORS
                ]

    cron_entry = ' '.join(cron_entry)

    return cron_entry


def main():

    wipe_cron()
    crontab_new = open('/etc/crontab_neu', 'a+')

    with closing(MySQLdb.connect(
            login.DB_HOST, login.DB_USER,
            login.DB_PASSWORD, login.DB_DATABASE
            )) as connection:

        with closing(connection.cursor()) as cursor:
            delete_outdated_from_db(connection, cursor)
            cursor.execute('SELECT * FROM timer')
            result = cursor.fetchall()

            for db_record in result:
                cron_entry = create_cron_entry(cursor, db_record)
                crontab_new.write(cron_entry + '\n')

    crontab_new.close
    os.rename('/etc/crontab_neu', '/etc/crontab')


if __name__ == '__main__':
    main()
