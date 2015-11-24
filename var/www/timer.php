<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RadioBeere - Timer verwalten</title>
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
            <h2>Timer verwalten</h2>

            <p>Wähle die Timer aus, die du löschen möchest.</p>

            <?php
            include("include/db-connect.php")
            ?>

            <?php
            if ($_POST['del'])
                {
                foreach ($_POST['del'] as $eintrag)
                    {
                    $loeschen = "DELETE FROM timer WHERE id = $eintrag";
                    $loesch = mysql_query($loeschen);
                    }
                exec("sudo /home/pi/radiobeere/rb-timer-update.py");
                unset($del);
                }
            ?>

            <form method="post">

                <?php
                $abfrage = "SELECT * FROM timer ORDER BY zeitstempel";
                $ergebnis = mysql_query($abfrage);
                $abfrage2 = "SELECT COUNT(id) FROM timer";
                $ergebnis2 = mysql_query($abfrage2);
                $anzahl_timer = mysql_fetch_row($ergebnis2);
                $anzahl_timer = $anzahl_timer[0];

                if ($anzahl_timer == 0)
                    {
                    echo "<h3>Keine Timer vorhanden.</h3><br>";
                    }

                while($row = mysql_fetch_object($ergebnis))
                    {
                    echo "<label><input name=\"del[]\" type=\"checkbox\" value=\"$row->id\" id=\"$row->id\">";
                    $dauer = $row->dauer/60;
                    $wochentage = $row->wochentage;
                    if ($wochentage != "*")
                        {
                        $klarnamen = array("So","Mo","Di","Mi","Do","Fr","Sa");
                        $i = "0";
                        while($i < 7)
                            {
                            $a = (string) "$i";
                            $pos = strpos($wochentage, $a);
                            if ($pos !== false)
                                {
                                $klartext .= "$klarnamen[$i], ";
                                }
                            $i++;
                            }
                        $wtage = substr_replace($klartext, '', -2, 2);
                        if ($wtage == "So, Mo, Di, Mi, Do, Fr, Sa")
                            {
                            $wtage = "T&auml;glich";
                            }
                        echo "$wtage - ";
                        }
                    else
                        {
                        echo "$row->tag.$row->monat. - ";
                        }
                    echo "$row->stunde:$row->minute Uhr - $row->sender - $dauer min.</label>";
                    echo "<br/>";
                    unset($wtage);
                    unset($klartext);
                    }
                ?>

                <input type="submit"
                      value="Ausgewählte Timer löschen" />
            </form>

            <div class="illu-content-wrapper">
                <div class="illu-content illu-timer">
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
