# RadioBeere

A radiorecorder for internet livestreams and audio server
based on the Raspberry Pi. See more information about
functionalities below.

Copyright (C) 2015  Tobias Gehle (github [a] tobias-gehle.de)


This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.


FURTHER LICENSE INFORMATION

Parts of this project are not published under the GPL. You should keep
this in mind, when thinking about redistributing the software. All
icons are taken from the Tango desktop icon set (with various
licenses), and the beautiful date picker by Amsul is licensed under MIT. 

The icons are either public domain, published under GPL or
Creative Commons CC BY-SA 3.0.

The origins are clearly labeled, you'll find more information
and attributions in the according directories: 

/var/www/js/pickadate.js-3.5.6
/var/www/img
/var/www/img/podcast


WHAT IS THE RADIOBEERE ABOUT?

The RadioBeere is a recorder for radio livestreams. The software consists
of a web frontend, written in PHP, running on an Apache webserver, and
a few Python scripts. The frontend is in german only, so far. But I might
change this later. We'll see. Feel free to fork me, if you can't wait. The
recording job is done by the well known streamripper package. Information
about stations, timers and recordings is stored in a MySQL database.
For ease of installation, I created a shell setup script, which basically
downloads and installs all dependencies and does almost all the configuration
work. See the installation instructions for details.

The frontend design is more or less responsive and thus can be used on small
and big screens equally. You can store your own list of radio stations, only
limited to streams, that streamripper can deal with. Once recorded, you can
listen to your recordings in different ways:

1) The RadioBeere creates a podcast feed for each radio station, you store on
your RadioBeere. So you can take your recordings with you and listen to
them offline.

2) The recordings are distributed within your LAN/Wifi network via a DLNA
server (ReadyMedia/minidlna). 

3) The RadioBeere has a very simple web player, basically a browsable list of
direct links to your mp3 files. 

4) The RadioBeere has Samba on board, so you can access your recordings just
like any content on a network share within your (W)LAN. This is a nice feature
for users of streaming clients like the SONOS players.


LEGAL AND SECURITY CONSIDERATIONS

The software is intended to make recording of PRIVATE copies of radio shows
easy. Please be aware of copyright rules in your country. Everyone using this
software for recording livestreams on the internet is responsible for what
he's doing. The RadioBeere must NOT be used for recording radio streams
intending to make the resulting audio files accessible for the public.

I assume, that you use your RadioBeere within your local network. Be warned:
Do NOT expose your Apache-Webserver, running on your RadioBeere, to the
internet, since the user www-data has certain sudo rights (see the setup code
for details). Even though the rights are restricted, this is NOT 100% secure. 

The RadioBeere software ist designed to be running on a Raspberry Pi with
Raspian installed (official version distributed by the Raspberry Foundation).
The system is meant to be on 24/7. The scripts should be suitable for any
Debian distro (or even other Linux flavours), though. If you want to use the
software on any other platform than a Raspberry Pi with Raspbian, you should
have a look at the source code and perhaps change it to your needs. 


ATTRIBUTIONS

There are several great projects the RadioBeere software is based on:

The frontend is made with PHP and running on an Apache webserver.
Information about stations, recordings and timers ist stored in a
MySQL database:

http://httpd.apache.org
http://www.mysql.de
http://www.php.net

The RadioBeere makes use of the jQuery library:

http://www.jquery.com

The scripts written in Python are using the standard library, with one
exception, the versatile tagging module Mutagen:

http://mutagen.readthedocs.org

The calendar helping you programming your recordings is Amsuls nice
Date Picker:

http://amsul.ca/pickadate.js

The recording work is done by the famous streamripper:

http://streamripper.sourceforge.net

Your recordings are served via DLNA by ReadyMedia, the server software
formerly knows as minidlna:

http://minidlna.sourceforge.net

The icons are all taken from the Tango library:

http://commons.m.wikimedia.org/wiki/Tango_icons 
http://commons.m.wikimedia.org/wiki/GNOME_Desktop_icons


Enjoy the RadioBeere and drop me a note, if you're encountering any
problems - or if you just love the programme :-)
