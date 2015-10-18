<!DOCTYPE html>
<html>
<head>
        <title>RadioBeere - Sender verwalten</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">

	<?php
	include("include/styling.php");
	?>
</head>

<body>

<div data-role="page" class="ui-responsive-panel" id="panel" data-title="RadioBeere" data-dom-cache="false">

        <div data-role="header">
                <a href="#nav-panel" data-icon="bars" data-iconpos="notext">Men&uuml;</a>
                <h1>RadioBeere</h1>
                <a href="/" data-icon="home" data-iconpos="notext">Startseite</a>
        </div>

<!--- Seiteninhalt --->

        <div data-role="main" class="ui-content">
	<h2>Sender verwalten</h2>

<?php
        include("include/db-connect.php");
?>



<?php
        if ($_POST['del'])
                {
                foreach ($_POST['del'] as $eintrag) {
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
	        $eintrag = "INSERT INTO sender (alias, name, url) VALUES ('$alias', '$name', '$url')";
        	$eintragen = mysql_query($eintrag);
                echo "<b><font color=\"#f00\">Sender gespeichert!</font></b><br><br>";
                }
	unset($row);
	unset($name);
	unset($url);
	echo "<script type=\"text/javascript\">setTimeout(function(){location.reload(true);}, 3000);</script>";
	}
?>


	<h3>Sender hinzufügen</h3>

        <form method="POST" id="hinzufuegen_sender">

	<label for="name">Name:
	<input type="text" name="name" id="name">
	</label>
        <label for="url">Stream-Adresse:
        <input type="text" name="url" id="url">
        </label>
	<br>
        <input type="submit" value="Sender speichern" form="hinzufuegen_sender">

	<p>Bitte keine Stream-Adressen angeben, die auf <b>.m3u</b> enden.
	Eine &Uuml;bersicht aller &ouml;ffentlich-rechtlichen Radioprogramme findest du hier:<br>
	<a href="http://web.ard.de/radio/radionet/" target="_blank">http://web.ard.de/radio/radionet/</a></p>
	<p>Dort kannst du die korrekten Stream-Adressen mit folgendem "Trick" herausfinden: W&auml;hle den gew&uuml;nschten
	Sender. Dann rechts unten auf "Interner Player" klicken. Es &ouml;ffnet sich ein Mini-Player. Darauf
	rechtsklicken und die Stream-Adresse kopieren.</p>
	<br>
	</form>


	<h3>Sender l&ouml;schen</h3>

        <form method="POST" id="loeschen_sender">

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
        echo "<label><input name=\"del[]\" type=\"checkbox\" value=\"$row->id\" multiple id=\"$row->id\">";
        echo "$row->name</label>";
        echo "<br/>";
        }

?>

	<a href="#popupDialog" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-icon-delete ui-btn-icon-left ui-btn-a">Gew&auml;hlte Sender l&ouml;schen</a>

	<div data-role="popup" id="popupDialog" data-history="false" data-dismissible="false" style="max-width:400px;">
	<div data-role="header">
	<h3>Best&auml;tigen</h3>
	</div>
        <div data-role="main" class="ui-content" align="center">
        <h4 class="ui-title">Sender wirklich l&ouml;schen?</h4>
	<p>Die zugeh&ouml;rigen Timer werden ebenfalls gel&ouml;scht!</p>
	<input id="submit" name="submit" type="submit" form="loeschen_sender" value="Ja" data-inline="true">
	<a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline" data-rel="back">Nein</a>
	</div>
        </div>

        </form>


        <div class="illu-contentbereich">
        <center><img src="/img/stations_256.png" alt=""></center>
        </div>

	</div>

<!--- Navigation --->

        <?php
        include("include/navigation.php");
        ?>

</div>

        <?php
        include("include/jquery.php");
        ?>

</body>

</html>
