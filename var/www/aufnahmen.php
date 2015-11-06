<!DOCTYPE html>
<html>
<head>
        <title>RadioBeere - Aufnahmen</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">

	<?php
	include("include/styling.php");
	?>
</head>

<body>

<div data-role="page" class="ui-responsive-panel" id="panel" data-title="RadioBeere">

        <div data-role="header">
                <a href="#nav-panel" data-icon="bars" data-iconpos="notext">Men&uuml;</a>
                <h1>RadioBeere</h1>
                <a href="/" data-icon="home" data-iconpos="notext">Startseite</a>
        </div>

<?php
        $filter_sender = $_POST["filter_sender"];
        if(!isset($filter_sender))
        {
        $filter_sender = "alle";
        }
?>

<!--- Seiteninhalt --->

        <div data-role="main" class="ui-content">
	<h2>Aufnahmen</h2>

<?php
        include("include/db-connect.php")
?>

<!--- Filtern nach Sender --->

        <div class="ui-field-contain">
        <form method="post" id="filter">
        <select name="filter_sender" onchange="if(this.value != 0) { this.form.submit(); }">
	<option value="alle">Alle Sender</option>
<?php
        $abfrage = "SELECT name FROM sender ORDER BY name";
        $ergebnis = mysql_query($abfrage);

        while($row = mysql_fetch_object($ergebnis))
        {
	if ($row->name == $filter_sender)
		{
                echo "<option value=\"$row->name\" selected>$row->name</option><br>";
		}
	else
		{
		echo "<option value=\"$row->name\">$row->name</option><br>";
		}
        }
        ?>

        </select>
        </form>
        </div>

<!--- Einträge in der DB und Files im Dateisystem loeschen --->

<?php
        if ($_POST['del'])
                {
                foreach ($_POST['del'] as $eintrag) {
                $loeschen = "DELETE FROM aufnahmen WHERE id = $eintrag";
	        $abfrage = "SELECT datei FROM aufnahmen WHERE id = $eintrag";
	        $ergebnis = mysql_query($abfrage);
		while($row = mysql_fetch_object($ergebnis))
   			{
   			$datei = "/var/www/Aufnahmen/$row->datei";
			}
		exec("rm $datei");
                $loesch = mysql_query($loeschen);
                	}
		unset($del);
                echo "<script type=\"text/javascript\">window.location.reload(true);</script>";
        	}
?>

<!--- Variablen für Pagination setzen --->

<?php
	$seite = $_POST["seite"];
	if(!isset($seite))
	{
	$seite = 1;
	}
	$eintraege_pro_seite = 5;
	$start = $seite * $eintraege_pro_seite - $eintraege_pro_seite;
	if($filter_sender == "alle")
		{
	        $abfrage = mysql_query("SELECT id FROM aufnahmen");
		}
	else
                {
                $abfrage = mysql_query("SELECT id FROM aufnahmen WHERE sender = '$filter_sender'");
                }
        $menge = mysql_num_rows($abfrage);
        $wieviel_seiten = $menge / $eintraege_pro_seite;
?>

<!--- Datenausgabe --->

        <form method="post" id="loeschen">

<?php
	if($menge > 1)
		{
		echo "<h3>$menge aufgenommene Sendungen</h3><br>";
		}
        if($menge == 1)
                {
                echo "<h3>$menge aufgenommene Sendung</h3><br>";
                }
        if($menge < 1)
                {
                echo "<h3>keine aufgenommenen Sendungen</h3><br>";
                }


        if($filter_sender == "alle")
		{
        	$abfrage = "SELECT * FROM aufnahmen ORDER BY zeitstempel DESC LIMIT $start, $eintraege_pro_seite";
		}
	else
		{
                $abfrage = "SELECT * FROM aufnahmen WHERE sender = '$filter_sender' ORDER BY zeitstempel DESC LIMIT $start, $eintraege_pro_seite";
		}
        $ergebnis = mysql_query($abfrage);

        while($row = mysql_fetch_object($ergebnis))
        {
        $tag = (substr($row->datum,8,2));
        $monat = (substr($row->datum,5,2));
        $jahr = (substr($row->datum,0,4));
	$uhrzeit = (substr($row->uhrzeit,0,5));
	echo "<b>$row->sender - $tag.$monat.$jahr - $uhrzeit Uhr ($row->laenge)</b><br>";
        echo "<a href=\"/Aufnahmen/$row->datei\" target=\"_blank\" class=\"ui-btn ui-icon-audio ui-btn-icon-left ui-btn-inline ui-corner-all ui-shadow\">Abspielen</a>";
        echo "<button data-icon=\"delete\" data-iconpos=\"left\" data-inline=\"true\" name=\"del[]\" value=\"$row->id\" id=\"$row->id\">L&ouml;schen</button>";
	echo "<br><br>";
        }

        echo "<input type=\"hidden\" name=\"seite\" value=\"$seite\">";
        echo "<input type=\"hidden\" name=\"filter_sender\" value=\"$filter_sender\">";

?>

	</form>

<!--- Pagination --->

<?php
        if($menge >= 1)
	{
	echo "<form method=\"post\" id=\"pagination\">";

        echo "<input type=\"hidden\" name=\"filter_sender\" value=\"$filter_sender\">";
	echo "<b>Seite:</b>&nbsp;&nbsp;";
	for($a=0; $a < $wieviel_seiten; $a++)
		{
		$b = $a + 1;
		if($seite == $b)
			{
                              echo "&nbsp;&nbsp;<input type=\"submit\" name=\"seite\" value=\"$b\" data-inline=\"true\">";
			}
		else
			{
                              echo "&nbsp;<input type=\"submit\" name=\"seite\" value=\"$b\" data-inline=\"true\" data-mini=\"true\">";
			}
		}
	echo "</form>";
	}
?>

        <div class="illu-contentbereich">
        <center><img src="/img/player_256.png" alt=""></center>
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
