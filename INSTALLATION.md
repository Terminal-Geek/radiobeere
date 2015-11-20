Installation of RadioBeere software


- 1 -

Install Raspian. I'm using the release officially supported by the Raspberry
Foundation:

http://www.raspberrypi.org

When done with that, update your system:

sudo apt-get update

sudo apt-get dist-upgrade


- 2 -

Login to your Raspberry Pi via ssh and call the Raspberry Pi configuration tool:

raspi-config

Choose the "Internationalisation Options" and the appropriate Locale and
Timezone for your location. Under "Advanced Options" you can choose an
individual host name. I chose "radiobeere", thus my recorder is available on
my LAN via http://radiobeere

If you have the official Raspian (as of late 2015) installed, the system will boot
to a X Windows environment by default. This is not, what we want. Change
this under "Boot Options" in raspi-config.


- 3 -

Now it's time to get the RadioBeere software on your machine:

cd /home/pi

git clone http://github.com/Terminal-Geek/radiobeere.git


- 4 -

Call the setup script and lay back.

cd /home/pi/radiobeere/setup

sudo ./setup

IMPORTANT NOTICE: You should only use the setup script on a freshly installed
system. Otherwise you risk loss of data. Be warned ... If you prefer to do all
of the configuration by yourself or are just interested in what the script does,
have a look at the setup script. It is commented generously.

When asked for a password for the MySQL root user, just choose one (a secure
one preferably). You'll be asked for it later during the installation process.

When asked for a password for a UNIX user, just wait 5 seconds and don't do anything.

The installation may take some time. Just get a fresh cup of coffee.
