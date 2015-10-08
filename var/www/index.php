<!DOCTYPE html>
<html>
<head>
	<title>RadioBeere</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf8">

	<?php
	include("include/styling.php");
	?>
</head>

<body>

<div data-role="page" class="ui-responsive-panel" id="panel" data-title="RadioBeere">

	<div data-role="header">
		<a href="#nav-panel" data-icon="bars" data-iconpos="notext">Men&uuml;</a>
		<h1>RadioBeere</h1>
	</div>

	<div data-role="main" class="ui-content" style="max-width:100% !important; text-align:center;">
        	<a href="record.php" class="ui-btn ui-input-btn ui-shadow ui-btn-inline""><img src="/img/timer_256.png" alt="Aufnahme planen" title="Aufnahme planen"><br>Aufnahme planen</a>
                <a href="timer.php" class="ui-btn ui-input-btn ui-shadow ui-btn-inline""><img src="/img/manage_timer_256.png" alt="Timer verwalten" title="Timer verwalten"><br>Timer verwalten</a>
                <a href="aufnahmen.php" class="ui-btn ui-input-btn ui-shadow ui-btn-inline""><img src="/img/player_256.png" alt="Player" title="Player"><br>Player</a>
                <a href="podcast.php" class="ui-btn ui-input-btn ui-shadow ui-btn-inline""><img src="/img/podcast_256.png" alt="Podcast" title="Podcast"><br>Podcast</a>
                <a href="stations.php" class="ui-btn ui-input-btn ui-shadow ui-btn-inline""><img src="/img/stations_256.png" alt="Sender verwalten" title="Sender verwalten"><br>Sender verwalten</a>
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
