<!DOCTYPE html>
<html>
<head>
        <title>RadioBeere - </title>

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

<!-- Seiteninhalt -->

        <div data-role="main" class="ui-content">
	<h2>Streaming</h2>

<p>Mit Hilfe der RadioBeere kannst du deine Aufnahmen auch
auf Geräten wiedergeben, die den so genannten DLNA-Standard unterstützen.
Diese Technik steckt in vielen moderen Mediengeräten drin: in Smart TVs,
AV-Receivern, Internetradios, Smartphones, Tablets, Streaming Clients ...
Die DLNA-Player-Funktion ist oft bereits im Auslieferungszustand integriert
oder sie kann über Apps nachgerüstet werden.</p>

<p>Der entscheidende Vorteil bei dieser Technik ist, dass die Medien, die
wiedergegeben sollen, nicht erst heruntergeladen werden müssen. Sie
werden während der Wiedergabe sukzessive vom Server
abgerufen.</p>  

<p>Um eine Aufnahme von der RadioBeere zu hören, muss sich das
Wiedergabegerät im selben Netzwerk befinden - was der Regelfall sein dürfte.
Wenn du die entsprechende Funktion auf deinem Gerät wählst, sollte die
RadioBeere dort als Medien-Server auftauchen. Der Rest ist selbsterklärend.</p>

<p>Mehr Informationen über den DLNA-Standard findest du auf
folgender Seite:</p>

<p><a href="http://www.dlna.org" target="_blank">http://www.dlna.org</a></p>

       <div class="illu-content-wrapper">
        <div class="illu-content illu-streaming">
        </div></div>
        
	</div>

<!-- Navigation -->

        <?php
        include("include/navigation.php");
        ?>

</div>

        <?php
        include("include/jquery.php");
        ?>

</body>

</html>
