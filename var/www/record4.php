<!DOCTYPE html>
<html>
<head>
        <title>RadioBeere - Aufnahme planen</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <link rel="stylesheet" href="/css/radiobeere.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
</head>

<body>

<!--- Variablen abrufen --->

	<?php
        $alias = $_POST["alias"];
        $stunde = $_POST["stunde"];
        $minute = $_POST["minute"];
        $dauer = $_POST["dauer"];
        $datum = $_POST["datum"];
        $wochentage = $_POST["wochentage"];
	?>

<!--- Verbindung zur Datenbank aufbauen --->

        <?php
        include("include/db-connect.php");
        ?>

<div data-role="page" class="ui-responsive-panel" id="panel" data-title="RadioBeere">

        <div data-role="header">
                <a href="#nav-panel" data-icon="bars" data-iconpos="notext">Men&uuml;</a>
                <h1>RadioBeere</h1>
                <a href="/" data-icon="home" data-iconpos="notext">Startseite</a>
        </div>


<!--- Variablen verarbeiten --->

<?php
	$sekunden = $dauer * 60;

	$abfrage = "SELECT name FROM sender WHERE alias = '$alias'";
        $ergebnis = mysql_query($abfrage);
        while($row = mysql_fetch_object($ergebnis))
        {
        $sender = "$row->name";
        }

	if ($datum !="")
        {
        $wochentage ="*";
	$tag = (substr($datum,0,2));
	$monat = (substr($datum,3,2));
	}
	else
	{
	$tag = "*";
	$monat = "*";
        $klarnamen = array("Sonntag","Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag");
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
	}
?>

<!--- Werte in die Datenbank schreiben --->

        <?php
        $eintrag = "INSERT INTO timer (sender, alias, stunde, minute, wochentage, dauer, tag, monat) VALUES ('$sender', '$alias', '$stunde', '$minute', '$wochentage', '$sekunden', '$tag', '$monat')";
        $eintragen = mysql_query($eintrag);
        ?>

<!--- Seiteninhalt --->

        <div role="main" class="ui-content">
        <h2>Aufnahme planen</h2>

	<p>Du hast folgende Aufnahme geplant:</p>
<?php

        echo "Sender: <b>$sender</b><br><br>";
        if ($datum != "")
	{
	echo "Datum: <b>$datum</b><br>";
	}
        echo "Uhrzeit: <b>$stunde:$minute Uhr</b><br>";
        echo "Dauer: <b>$dauer Minuten</b><br>";
	if ($wtage != "")
	{
        echo "Wochentage: <b>$wtage</b>";
	}

?>

        <div align="center" class="illu-contentbereich">
        <center><img src="/img/timer_256.png" alt="Aufnahmen planen">
        </div>

</div>

<!--- Navigation --->

        <div data-role="panel" data-display="push" data-theme="a" id="nav-panel">
                <ul data-role="listview">
                <li data-icon="delete"><a href="#" data-rel="close">Men&uuml; schlie&szlig;en</a></li>
                <li><a href="record.php">Aufnahme planen</a></li>
                <li><a href="timer.php">Timer verwalten</a></li>
                <li><a href="player.php">Player</a></li>
                <li><a href="podcast.php">Podcast</a></li>
                <li><a href="stations.php">Sender verwalten</a></li>
                <li><a href="dlna.php">Streaming Server</a></li>
                <li><a href="samba.php">Dateien verwalten</a></li>
                <li><a href="help.php">Hilfe</a></li>
                </ul>
        </div>

</div>

        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
                <script type='text/javascript'>
                <!--
                $(document).bind('mobileinit',function(){
                $.extend(  $.mobile , {
                defaultPageTransition: "none"
                });
                });
                //-->
                </script>

</body>

</html>
