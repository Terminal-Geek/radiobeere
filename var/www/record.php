<!DOCTYPE html>
<html>
<head>
        <title>RadioBeere - Aufnahmen planen</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">

        <link rel="stylesheet" href="/css/radiobeere.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
</head>

<body>

<!--- Verbindung zur Datenbank aufbauen --->

	<?php
	include("include/db-connect.php");
	?>

<!--- Variablen abrufen --->

        <?php
        $reset = $_POST["reset"];
	?>

<!--- Letzten Timer löschen --->

	<?php
        if ($reset == "1")
        {
	$abfrage = "SELECT id FROM timer ORDER BY id DESC LIMIT 1";
	$ergebnis = mysql_query($abfrage);
	while($row = mysql_fetch_object($ergebnis))
   	{
	$id =("$row->id");
   	}
	$loeschen = "DELETE FROM timer WHERE id = '$id'";
	$loesch = mysql_query($loeschen);
	$reset = "0";
	}
	?>

<div data-role="page" class="ui-responsive-panel" id="panel" data-title="RadioBeere">

        <div data-role="header">
                <a href="#nav-panel" data-icon="bars" data-iconpos="notext">Men&uuml;</a>
                <h1>RadioBeere</h1>
                <a href="/" data-icon="home" data-iconpos="notext">Startseite</a>
        </div>

<!--- Seiteninhalt --->

        <div role="main" class="ui-content">
	<h2>Aufnahme planen</h2>

	<p>Was m&ouml;chtest du aufnehmen?</p>

<!--- Formular --->

	<div class="ui-field-contain">
	<form action="record2.php" method="post">
        <select name="alias" onchange="if(this.value != 0) { this.form.submit(); }">
	<option value="">Sender ausw&auml;hlen</option>

	<?php
	$abfrage = "SELECT name,alias FROM sender";
	$ergebnis = mysql_query($abfrage);

	while($row = mysql_fetch_object($ergebnis))
   	{
	echo "<option value=\"$row->alias\">$row->name</option><br>";
   	}
	?>

	</select>
	</form>
        </div>


        <div class="illu-contentbereich">
        <center><img src="/img/timer_256.png" alt="Aufnahme planen"></center>
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
