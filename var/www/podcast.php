<!DOCTYPE html>
<html>
<head>
        <title>RadioBeere - Podcast</title>

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

        <div data-role="main" class="ui-content">
	<h2>Podcast</h2>

	<p>Klicke den Link an, um deine eigenen Radio-Aufnahmen als Podcast zu
	abonnieren. Sollte das nicht automatisch klappen, kannst du den Link kopieren
	und in deinem Podcast-Programm (z.B. iTunes) einfügen, um den Podcast von Hand
	zu abonnieren.</p>

	<p><a href="http://radiobeere/podcast/dircaster.php" target="_blank">http://radiobeere/podcast/dircaster.php</a></p>



        <div class="illu-contentbereich">
        <center><img src="/img/podcast_256.png" alt=""></center>
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
