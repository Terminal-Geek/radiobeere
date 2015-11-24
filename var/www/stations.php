<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RadioBeere - Sender verwalten</title>
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
         data-title="RadioBeere"
         data-dom-cache="false">
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
            <h2>Sender verwalten</h2>

            <?php
            include("include/db-connect.php");
            ?>

<!-- Delete stations and related timers -->

            <?php
            if ($_POST['del'])
                {
                foreach ($_POST['del'] as $eintrag)
                    {
                    $abfrage_sender = "SELECT * FROM sender WHERE id = $eintrag";
                    $ergebnis = mysql_query($abfrage_sender);
                    while($row = mysql_fetch_object($ergebnis))
                        {
                        $loeschen_timer = "DELETE FROM timer WHERE alias = '$row->alias'";
                        $loesch_timer = mysql_query($loeschen_timer);
                        }
                    $loeschen = "DELETE FROM sender WHERE id = $eintrag";
                    $loesch = mysql_query($loeschen);
                    }
                unset($del);
                exec("sudo /home/pi/radiobeere/rb-timer-update.py");
                echo "<b><font color=\"#f00\">Sender gel&ouml;scht!</font></b><br><br>";
                echo "<script type=\"text/javascript\">setTimeout(function(){location.reload(true);}, 3000);</script>";
                }
            ?>

<!-- Add stations -->

            <?php
            $name = $_POST["name"];
            $url = $_POST["url"];

            if ($name !="")
                {
                $alias = strtolower(eregi_replace(" ", "", $name));
                $alias = preg_replace("/[^0-9a-zA-Z \-\_]/", "", $alias);
                $abfrage = "SELECT * FROM sender WHERE alias = '$alias' OR url = '$url'";
                $ergebnis = mysql_query($abfrage);
                $row = mysql_fetch_row($ergebnis);
                if ($row != "")
                    {
                    echo "<b><font color=\"#f00\">Sender bereits in der Datenbank!</font></b><br><br>";
                    }
                else
                    {
                    if ($_FILES['cover']['tmp_name'] !="")
                        {
                        $datei = GetImageSize($_FILES['cover'][strtolower('tmp_name')]);
                        $breite = $datei[0];
                        $laenge = $datei[1];
                        $typ = $datei[2];
                        $size = $_FILES['cover']['size'];

                        if($typ == 2 AND $typ != 0)
                            {
                            if($size <  512000)
                                {
                                move_uploaded_file($_FILES['cover']['tmp_name'], "img/podcast/".$alias.".jpg");
                                $eintrag = "INSERT INTO sender (alias, name, url) VALUES ('$alias', '$name', '$url')";
                                $eintragen = mysql_query($eintrag);
                                exec("sudo /home/pi/radiobeere/podcast.py $alias");
                                echo "<b><font color=\"#f00\">Sender gespeichert!</font></b><br><br>";
                                }
                            else
                                {
                                echo "<b><font color=\"#f00\">Das Bild darf nicht größer als ein halbes Megabyte sein.
                                Der Sender wurde nicht gespeichert. Bitte versuche es nochmals.<br><br></font></b>";
                                }
                            }
                        else
                            {
                            echo "<b><font color=\"#f00\">Bitte nur Dateien mit der Endung .jpg oder .jpeg hochladen.
                            Der Sender wurde nicht gespeichert. Bitte versuche es nochmals.<br><br></font></b>";
                            }
                        }

                    else
                        {
                        $eintrag = "INSERT INTO sender (alias, name, url) VALUES ('$alias', '$name', '$url')";
                        $eintragen = mysql_query($eintrag);
                        exec("sudo /home/pi/radiobeere/podcast.py $alias");
                        echo "<b><font color=\"#f00\">Sender gespeichert!</font></b><br><br>";
                        }
                    }

                unset($row);
                unset($name);
                unset($url);
                unset($_FILES);
                echo "<script type=\"text/javascript\">setTimeout(function(){location.reload(true);}, 6000);</script>";
                }
            ?>

            <h3>Sender hinzufügen</h3>

            <form method="post"
                  id="hinzufuegen_sender"
                  enctype="multipart/form-data">
                <label for="name">Name: <input type="text"
                       name="name"
                       id="name" /></label> <label for="url">Stream-Adresse:
                       <input type="text"
                       name="url"
                       id="url" /></label> <label for="cover">Sender-Bild
                       (optional): <input type="file"
                       name="cover"
                       id="cover" /></label><br />
                <input type="submit"
                      value="Sender speichern"
                      form="hinzufuegen_sender" />

                <p>Bitte keine Stream-Adressen angeben, die auf <b>.m3u</b>
                enden. Eine Übersicht aller öffentlich-rechtlichen
                Radioprogramme findest du hier:<br />
                <a href="http://web.ard.de/radio/radionet/"
                   target="_blank">http://web.ard.de/radio/radionet/</a></p>
                <p>Dort kannst du die korrekten Stream-Adressen mit folgendem
                "Trick" herausfinden: Wähle den gewünschten Sender. Dann rechts
                unten auf "Interner Player" klicken. Es öffnet sich ein
                Mini-Player. Darauf rechtsklicken und die Stream-Adresse
                kopieren.</p>
                <br />
            </form>

            <h3>Sender löschen</h3>

            <form method="post"
                  id="loeschen_sender">

                <?php
                $abfrage = "SELECT * FROM sender ORDER BY name";
                $ergebnis = mysql_query($abfrage);
                $abfrage2 = "SELECT COUNT(id) FROM sender";
                $ergebnis2 = mysql_query($abfrage2);
                $anzahl_sender = mysql_fetch_row($ergebnis2);
                $anzahl_sender = $anzahl_sender[0];

                if ($anzahl_sender == 0)
                    {
                    echo "<h3>Keine Sender vorhanden.</h3><br>";
                    }
                while($row = mysql_fetch_object($ergebnis))
                    {
                    echo "<label><input name=\"del[]\" type=\"checkbox\" value=\"$row->id\" id=\"$row->id\">";
                    echo "$row->name</label>";
                    echo "<br/>";
                    }
                ?>

                <a href="#popupDialog"
                      data-rel="popup"
                      data-position-to="window"
                      data-transition="pop"
                      class=
                      "ui-btn ui-corner-all ui-shadow ui-icon-delete ui-btn-icon-left ui-btn-a">Gewählte
                      Sender löschen</a>

                <div data-role="popup"
                     id="popupDialog"
                     data-history="false"
                     data-dismissible="false"
                     style="max-width:400px;">
                    <div data-role="header">
                        <h3>Bestätigen</h3>
                    </div>

                    <div data-role="main"
                         class="ui-content popup">

                        <h4 class="ui-title">Sender wirklich löschen?</h4>

                        <p>Die zugehörigen Timer werden ebenfalls gelöscht!</p>
                        <input id="submit"
                             name="submit"
                             type="submit"
                             form="loeschen_sender"
                             value="Ja"
                             data-inline="true" />
                             <a href="#"
                             class=
                             "ui-btn ui-corner-all ui-shadow ui-btn-inline"
                             data-rel="back">Nein</a>
                    </div>
                </div>
            </form>

            <div class="illu-content-wrapper">
                <div class="illu-content illu-stations">
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
