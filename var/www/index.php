<!DOCTYPE html>
<html>
<head>
	<title>RadioBeere</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="/css/radiobeere.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
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

</body>
</html>
