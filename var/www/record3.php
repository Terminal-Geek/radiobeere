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
        $datum = $_POST["datum"];
        $wochentage = $_POST["wochentage"];
                if($wochentage == "")
                {
                $wochentage = "*";
		}
		else
		{
		foreach($wochentage AS $wochentag)
		{
		ob_start();
		echo "$wochentag,";
		$tage .= ob_get_contents();
		ob_end_clean();
		}
		$wochentage = trim($tage, ",");
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

        <p>W&auml;hle Uhrzeit und L&auml;nge der Aufnahme.</p>

<!--- Beginn Formular --->

	<form action="record4.php" method="post">

	<?php
	echo "<input type=\"hidden\" name=\"alias\" value=\"$alias\">";
        echo "<input type=\"hidden\" name=\"datum\" value=\"$datum\">";
        echo "<input type=\"hidden\" name=\"wochentage\" value=\"$wochentage\">";
	?>

	<p>Uhrzeit (hh:mm):</p>

	<div data-role="controlgroup" data-type="horizontal">
	<select name="stunde">
	<option value="00">00</option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
	</select>

	<select name="minute">
	<option value="00">00</option>
        <option value="05">05</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="25">25</option>
        <option value="30">30</option>
        <option value="35">35</option>
        <option value="40">40</option>
        <option value="45">45</option>
        <option value="50">50</option>
        <option value="55">55</option>
	</select>
	</div>

	<br>
	<p>Dauer der Aufnahme (in Minuten):</p>

	<input type="text" name="dauer">

	<br><br><button type="submit" name="submit">Programmierung abschlie&szlig;en</button>
	</form>


        <div class="illu-contentbereich">
        <center><img src="/img/timer_256.png" alt="Aufnahmen planen"></center>
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
