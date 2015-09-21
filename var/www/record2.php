<!DOCTYPE html>
<html>
<head>
        <title>RadioBeere - Aufnahme planen</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">

        <link rel="stylesheet" href="/css/radiobeere.css">
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<link rel="stylesheet" href="/js/pickadate.js-3.5.6/lib/themes/default.css" id="theme_base">
	<link rel="stylesheet" href="/js/pickadate.js-3.5.6/lib/themes/default.date.css" id="theme_date">
</head>

<body>

<!--- Variable abrufen --->

	<?php
	$alias = $_POST["alias"];
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

	<h3>Eine einzelne Sendung aufnehmen</h3>

	<p>Planst du eine einzelne Aufnahme ohne Wiederholungstermine? Dann w&auml;hle ein Datum und klicke auf "N&auml;chster Schritt". Wenn du eine Sendung wiederholt aufnehmen m&ouml;chtest, zum Beispiel deine t&auml;gliche Lieblingssendung, dann lasse das Datumsfeld frei und gib stattdessen die Wochentage f&uuml;r deine Serienaufnahme an.</p>

        <form action="record3.php" method="post">
	<?php
        echo "<input type=\"hidden\" name=\"alias\" value=\"$alias\">";
        ?>

	<input type="text" id="datepicker" name="datum" class="datepicker" placeholder="Datum w&auml;hlen">
        <br><br><button type="submit" name="submit">N&auml;chster Schritt</button>

	<br><br>

	<name="Serienaufnahme"><h3>Serienaufnahme</h3></a>
	<p>W&auml;hle die Wochentage, an denen du eine bestimmte Sendung regelm&auml;&szlig;ig aufnehmen m&ouml;chtest. Im n&auml;chsten Schritt kannst du Sendezeit und L&auml;nge eingeben.</p>
	<br>
        <fieldset>
        <label for="check1">
        <input type="checkbox" name="wochentage[]" value="1" id="check1">
        Montag
        </label>
        <label for="check2">
        <input type="checkbox" name="wochentage[]" value="2" id="check2">
        Dienstag
        </label>
        <label for="check3">
        <input type="checkbox" name="wochentage[]" value="3" id="check3">
        Mittwoch
        </label>
        <label for="check4">
        <input type="checkbox" name="wochentage[]" value="4" id="check4">
        Donnerstag
        </label>
        <label for="check5"
        ><input type="checkbox" name="wochentage[]" value="5" id="check5">
        Freitag
        </label>
        <label for="check6">
        <input type="checkbox" name="wochentage[]" value="6" id="check6">
        Samstag
        </label>
        <label for="check7">
        <input type="checkbox" name="wochentage[]" value="0" id="check7">
        Sonntag
        </label>
        </fieldset>

        <br><br><button type="submit" name="submit">N&auml;chster Schritt</button>
	</form>

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
        <script src="/js/pickadate.js-3.5.6/lib/picker.js"></script>
        <script src="/js/pickadate.js-3.5.6/lib/legacy.js"></script>
        <script src="/js/pickadate.js-3.5.6/lib/picker.date.js"></script>
        <script src="/js/pickadate.js-3.5.6/lib/translations/de_DE.js"></script>

                <script type='text/javascript'>
                <!--
                $(document).bind('mobileinit',function(){
                $.extend(  $.mobile , {
                defaultPageTransition: "none"
                });
                });
                //-->
                </script>

                <script type='text/javascript'>
                $(function() {
                $('.datepicker').pickadate({
                firstDay: 1,
		format: 'dd.mm.yyyy'
                });
                });
                </script>

</body>

</html>
