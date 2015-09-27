<!DOCTYPE html>
<html>
<head>
	<title>RadioBeere</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="/css/radiobeere.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
</head>

<body>

<div data-role="page" class="ui-responsive-panel" id="panel" data-title="RadioBeere">

	<div data-role="header">
		<a href="#nav-panel" data-icon="bars" data-iconpos="notext">Men&uuml;</a>
		<h1>RadioBeere</h1>
	</div>

	<div role="main" class="ui-content">
        	<a href="record.php" class="ui-btn ui-input-btn ui-shadow ui-btn-inline""><img src="/img/timer_256.png" alt="Aufnahme planen" title="Aufnahme planen"><br>Aufnahmen planen</a>
                <a href="manage_timer.php" class="ui-btn ui-input-btn ui-shadow ui-btn-inline""><img src="/img/manage_timer_256.png" alt="Timer verwalten" title="Timer verwalten"><br>Timer verwalten</a>
                <a href="player.php" class="ui-btn ui-input-btn ui-shadow ui-btn-inline""><img src="/img/player_256.png" alt="Player" title="Player"><br>Player</a>
                <a href="podcast.php" class="ui-btn ui-input-btn ui-shadow ui-btn-inline""><img src="/img/podcast_256.png" alt="Podcast" title="Podcast"><br>Podcast</a>
                <a href="manage_stations.php" class="ui-btn ui-input-btn ui-shadow ui-btn-inline""><img src="/img/sender_256.png" alt="Sender verwalten" title="Sender verwalten"><br>Sender verwalten</a>
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
