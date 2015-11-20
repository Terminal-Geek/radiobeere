<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RadioBeere - Hilfe</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <?php
    include("include/styling.php");
    ?>
</head>

<body>
    <div data-role="page"
         class="ui-responsive-panel"
         id="panel"
         data-title="RadioBeere">

        <div data-role="header">
            <a href="#nav-panel"
                 data-icon="bars"
                 data-iconpos="notext">Menü</a>

            <h1>RadioBeere</h1>
            <a href="/"
                 data-icon="home"
                 data-iconpos="notext">Startseite</a>
        </div>

        <div data-role="main"
             class="ui-content">
            <h2>Hilfe</h2>

            <div data-role="collapsible">
                <h3>Was ist die RadioBeere?</h3>
                <p>Ein moderner Radiorecorder. Die Software nimmt Livestreams
                von Radiostationen im Internet auf. Bei der Wahl der Sender
                macht das System keine Vorgabe. Du trägst selbst "deine"
                Sender in die Datenbank ein - und schon kann's
                losgehen.</p>
            </div>

            <div data-role="collapsible">
                <h3>Wie gebe ich meine Aufnahmen wieder?</h3>
                <p>Die Idee hinter der Radiobeere ist, den Nutzer nicht
                festzulegen, weder auf ein bestimmtes System, eine
                Technologie, eine proprietäre Plattform oder einen Hersteller.
                Deshalb hast du mannigfaltige Möglichkeiten, deine
                aufgenommenen Radiosendungen zu genießen:</p>

                <ol>
                <li><p>Du abonnierst deine aufgenommenen Sendungen als Podcast.
                So kannst du dir deine Aufnahmen zum Beispiel auf dein
                Smartphone laden und unterwegs hören, auch wenn du keinen
                Internet-Anschluss hast. Da ich Apple-Nutzer bin, abonniere
                ich meine Podcasts mit iTunes. Das System ist aber offen
                (s.o.), du kannst also auch jede andere Podcast-Software oder
                -App nutzen.
                <br /><br />
                <a href="podcast.php">Zu deinen Podcasts</a></p></li>

                <li><p>Du nutzt den integrierten Player. Eigentlich ist der eher
                als "Notlösung" gedacht, mag aber für den ein oder andern
                Anwender das Mittel der Wahl sein. Für die Nutzung des
                Web-Player musst du dich in deinem Heim-Netzwerk befinden.
                <br /><br />
                <a href="aufnahmen.php">Zum Web-Player</a></p></li>

                <li><p>Wenn du ein DLNA-fähiges Wiedergabegerät besitzt, zum
                Beispiel ein Internetradio oder einen Streaming-Client, kannst
                du deine Aufnahmen über den integrierten DLNA-Server auf dein
                Gerät streamen. Auch für die Nutzung der DLNA-Funktion musst
                du dich in deinem Heim-Netzwerk befinden.
                <br /><br />
                <a href="streaming.php">Mehr Infos zur Wiedergabe per
                DLNA-Standard</a></p></li>

                <li><p>Du bindest die Netzwerk-Freigabe (Samba) der RadioBeere auf
                deinem Computer oder deinem Streaming-Client ein. Schau mal in
                deinen Explorer bzw. Finder, dort solltest du unter "Netzwerk"
                einen Eintrag RadioBeere finden. Einfach mal
                draufklicken ...<br /><br />
                Wenn du nach Zugangsdaten gefragt wirst, gib folgende ein:
                <br /><br />
                Nutzer: <code>radiobeere</code><br />
                Passwort: <code>radiobeere</code>
                <br /><br />
                Der Pfad für die Einbindung beispielsweise in einem
                SONOS-Streaming-Client lautet:
                <br /><br />
                <?php
                    $hostname = gethostname();
                    echo "<code>//".$hostname."/aufnahmen</code>";
                    ?>
                </p></li>
                </ol>
            </div>

            <div data-role="collapsible">
                <h3>Wie kann ich Aufnahmen löschen?</h3>
                <p>Der Normalnutzer erledigt das am besten über die
                Player-Seite:<br><br>
                <a href="aufnahmen.php">Zur Player-Seite</a></p>
                <p>Versierte Nutzer können sich auch per SSH in ihr System
                einloggen und Aufnahmen über die Eingabe eines Shell-Befehls
                löschen. Oder aber sie erstellen eine Samba-Netzwerk-Freigabe
                mit Schreibrechten, binden diese auf ihrem Computer ein und
                löschen Aufnahmen bequem über ihr (X)Windows-System.</p>
            </div>

            <div data-role="collapsible">
                <h3>Auf welcher Hardware läuft die Software?</h3>

                <p>Konzipiert ist die RadioBeere für den Raspberry Pi, einen
                günstigen Mini-Computer mit beeindruckend geringem
                Stromverbrauch. Das Gerät ist "always on", muss also für eine
                Radioaufnahme nicht extra gestartet werden.</p>
                <p>Ursprünglich wurde der Pi als günstiger Schulcomputer
                entwickelt, um (jungen) Menschen das Programmieren
                beizubringen. Das System ist aber auch bei Programmieren und
                Bastlern sehr beliebt, nicht zuletzt, weil es über seine
                integrierten Ein- und Ausgabe-Pins Kontakt mit der physischen
                Welt aufnehmen kann und zum Beispiel Motoren steuert oder auf
                Knopfdruck bestimmte Programme startet. Der Raspberry Pi wird
                auch gern als Alternative zu proprietären NAS-Systemen
                genutzt. Eine NAS (Network Attached Storage) speichert Dateien
                (z.B. Musik oder Filme) zentral im Heimnetzwerk.</p>
                <p>Mehr zum Raspberry Pi:<br /><br />
                <a href="http://www.raspberrypi.org" target="_blank">
                http://www.raspberrypi.org</a></p>

                <p>Grundsätzlich läuft die Software aber auch auf jeder
                anderen Maschine, auf der sich ein Debian Linux installieren
                lässt (oder eine vergleichbare Distribution, wie etwa Ubuntu).
                Etwaige Veränderungen am Code sind aber in eigener
                Verantwortung vorzunehmen ;-)</p>
            </div>

            <div data-role="collapsible">
                <h3>Wie komme ich an Updates?</h3>
                <p>Um die Aktualisierung des Betriebssystems musst du dich
                nicht kümmern. Jede Nacht läuft ein Update-Check. Sofern neue
                Versionen von Betriebssystem-Komponenten vorhanden sind,
                werden diese automatisch installiert.</p>
                <p>Wer's genau wissen will: Per Cronjob wird ein <code>apt-get
                dist-upgrade</code> durchgeführt. Was dabei installiert wird
                oder ob Fehler aufgetaucht sind, steht in folgendem Log-File:
                <br /><br />
                <a href="dist-upgrade.log" target="_blank">/var/www/dist-upgrade.log</a></p>
                <p>Die RadioBeere-Software selbst wird dabei nicht
                aktualisiert. Dies kannst du auf der Seite
                <a href="maintenance.php">Wartung</a>
                von Hand mit einem Klick erledigen.</p>
            </div>

            <div data-role="collapsible">
                <h3>Wie schließe ich die Radiobeere ans Heimnetzwerk an?</h3>
                <p>Wenn du dies liest, hast du das wahrscheinlich schon
                erledigt ;-) Die Frage könnte auch lauten: Warum wird der
                Raspberry Pi mit einen Kabel an den Router bzw. einen Hub
                angeschlossen, und nicht per W-LAN?</p>
                <p>Das ginge natürlich auch, hat aber folgende Nachteile:</p>
                <ul>
                    <li>Der Anschluss über Drahtlosnetzwerk erfordert
                    zusätzliche Hardware: einen USB-Wireless-LAN-Adapter.
                    Kostet nicht die Welt, aber ...</li>
                    <li>Ein W-LAN-Adapter frisst zusätzlich Strom.</li>
                    <li>Eine Wireless-Verbindung ist nie so stabil wie eine
                    Netzwerkverbindung, die über Kabel hergestellt wird.</li>
                    <li>Eine W-LAN-Verbindung würde beim Anwender zusätzlichen
                    Einrichtungsaufwand bedeuten: Der Raspberry Pi müsste erstmal
                    mit dem W-LAN verbunden werden, sprich: Das Kennwort
                    deines Wifi-Netzwerks müsste im Pi hinterlegt werden.
                    Das ist nicht ganz so banal.</li>
                </ul>
            </div>

            <div data-role="collapsible">
                <h3>Unter der Motorhaube ODER Danksagungen</h3>

                <p>Dieses Projekt wäre nicht möglich gewesen ohne Open Source
                und ohne die vielen Menschen, die in Technik ebenso vernarrt
                sind wie ich, die in zahllosen (mutmaßlich oft nächtlichen)
                Sitzungen ein Universum quelloffener Software geschaffen
                haben. Weil ich die Open Source-Idee so sympathisch finde,
                steht selbstverständlich auch die RadioBeere unter einer
                GPL-Lizenz zur freien Verfügung. Einige Projekte, die Eingang
                in die Software der RadioBeere gefunden haben, möchte ich
                explizit erwähnen. Nicht alle stehen selbst unter GPL-Lizenz,
                Lizenzhinweise sind in demselben Verzeichnis zu finden, in dem
                auch die jeweiligen Komponenten liegen.</p>

                <p>Auf dem Raspberry Pi, der Hardware-Plattform der
                RadioBeere, läuft Raspian, und zwar in der offiziellen, von
                der Raspberry-Stiftung adaptierten Version. Raspbian ist eine
                Variante der weit verbreiteten Linux-Distribution Debian
                (zur Zeit des Starts des Projekts Raspbian Jessie):
                <br /><br />
                <a href="http://www.raspberrypi.org/downloads/raspbian/"
                    target="_blank">http://www.raspberrypi.org/downloads/raspbian/
                    </a></p>

                <p>Die Webseiten sind in PHP programmiert und laufen auf
                einem Apache-Webserver. Die Datensätze für Aufnahmen, Sender
                und Timer werden in einer MySQL-Datenbank abgelegt.
                <br /><br />
                <a href="http://httpd.apache.org" target="_blank">
                http://httpd.apache.org</a><br>
                <a href="http://www.mysql.de" target="_blank">
                http://www.mysql.de</a><br>
                <a href="http://www.php.net" target="_blank">
                http://www.php.net</a></p>

                <p>Zum Einsatz kommen außerdem die jQuery Javascript-Bibliothek
                und jQuery mobile. Diese Bibliotheken erfreuen sich großer
                Beliebtheit, nicht zuletzt, weil sie relativ einfach zu
                handhaben sind.<br /><br />
                <a href="http://www.jquery.com" target="_blank">
                http://www.jquery.com</a></p>

                <p>Die Skripte, die im Hintergrund werkeln, sind in Python
                programmiert. Neben der Standard-Bibliothek kommt für das
                ID3-Tagging der Aufnahmen das Modul Mutagen zum Einsatz:
                <br /><br />
                <a href="http://mutagen.readthedocs.org" target="_blank">
                http://mutagen.readthedocs.org</a></p>

                <p>Bei der Programmierung von Aufnahmen verwende ich für den
                Kalender den responsiven Date Picker von Amsul:<br /><br />
                <a href="http://amsul.ca/pickadate.js" target="_blank">
                http://amsul.ca/pickadate.js</a></p>

                <p>Die Radioaufnahmen selbst erledigt der grundsolide, wenn
                auch schon etwas in die Jahre gekommene Streamripper, den ich
                aus den Standard-Quellen installiert habe:<br /><br />
                <a href="http://streamripper.sourceforge.net" target="_blank">
                http://streamripper.sourceforge.net</a></p>

                <p>Die Verteilung der Audiodateien im Heimnetzwerk via DLNA
                übernimmt der ReadyMedia-Server, vormals bekannt unter dem
                Namen miniDLNA:<br /><br />
                <a href="http://minidlna.sourceforge.net" target="_blank">
                http://minidlna.sourceforge.net</a></p>

                <p>Die Bilder stammen aus der Tango Icon Libray:<br /><br />
                <a href="http://commons.m.wikimedia.org/wiki/Tango_icons"
                target="_blank">http://commons.m.wikimedia.org/wiki/Tango_icons
                </a><br />
                <a href="http://commons.m.wikimedia.org/wiki/GNOME_Desktop_icons"
                target="_blank">http://commons.m.wikimedia.org/wiki/GNOME_Desktop_icons
                </a></p>
            </div>

            <div data-role="collapsible">
                <h3>Haftungsausschluss</h3>
                <p>Jeder, der diese Software verwendet, ist selbst
                verantwortlich für das, was er tut. Ich hafte für keinerlei
                Schäden, weder materieller noch immaterieller Natur, zum
                Beispiel Schäden an der Hardware oder Datenverlust, die durch
                das Herunterladen und Verwenden der RadioBeere-Software
                entstehen.</p>
                <p>Die RadioBeere ist gedacht für Privatkopien von
                Radiosendungen im Rahmen der geltenden Urhebergesetze.
                Die Regelungen zur Privatkopie sind von Land zu Land
                unterschiedlich. Jeder ist selbst dafür verantwortlich, zu
                wissen und zu entscheiden, ob er mit der Radiobeere die
                Kopie einer Radiosendung anfertigen darf oder nicht.</p>
            </div>

            <div class="illu-content-wrapper">
                <div class="illu-content illu-help">
                </div>
            </div>
        </div>
        <?php
        include("include/navigation.php");
        ?>
    </div>
    <?php
    include("include/jquery.php");
    ?>
</body>
</html>
