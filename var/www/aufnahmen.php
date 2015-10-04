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

<!--- Seiteninhalt --->

        <div role="main" class="ui-content">
	<h2>Aufnahmen</h2>

<?php
        include("include/db-connect.php")
?>

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
        	}
?>

<!--- Variablen für Pagination setzen --->

<?php
	$seite = $_GET["seite"];
	if(!isset($seite))
	{
	$seite = 1;
	}
	$eintraege_pro_seite = 5;
	$start = $seite * $eintraege_pro_seite - $eintraege_pro_seite;
        $abfrage = mysql_query("SELECT id FROM aufnahmen");
        $menge = mysql_num_rows($abfrage);
        $wieviel_seiten = $menge / $eintraege_pro_seite;
?>

<!--- Datenausgabe --->

        <form method="POST">

<?php
        $abfrage = "SELECT * FROM aufnahmen ORDER BY zeitstempel DESC LIMIT $start, $eintraege_pro_seite";
        $ergebnis = mysql_query($abfrage);

        while($row = mysql_fetch_object($ergebnis))
        {
        $tag = (substr($row->datum,8,2));
        $monat = (substr($row->datum,5,2));
        $jahr = (substr($row->datum,0,4));
	echo "<b>$row->sender, $tag.$monat.$jahr, $row->uhrzeit Uhr</b><br>";
	echo "<button data-icon=\"audio\" data-iconpos=\"left\" data-inline=\"true\">Play</button>";
        echo "<a href=\"/Aufnahmen/$row->datei\" target=\"_blank\" class=\"ui-btn ui-icon-arrow-d ui-btn-icon-left ui-btn-inline ui-corner-all ui-shadow\">Download</a>";
        echo "<button data-icon=\"delete\" data-iconpos=\"left\" data-inline=\"true\" name=\"del[]\" value=\"$row->id\" id=\"$row->id\">L&ouml;schen</button>";
	echo "<br><br>";
        }

        echo "<input type=\"hidden\" name=\"seite\" value=\"$seite\">";

?>
	</form>

<!--- Pagination --->

<?php
	echo "<b>Seite:</b>&nbsp;&nbsp;";
	for($a=0; $a < $wieviel_seiten; $a++)
		{
		$b = $a + 1;
		if($seite == $b)
			{
      			echo "&nbsp;&nbsp;<button class=\"ui-btn ui-btn-inline\">$b</button>";
			}
		else
			{
			echo "<a href=\"?seite=$b\" class=\"ui-btn ui-btn-inline ui-mini\"><b><u>$b</u></b></a>";
			}
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
