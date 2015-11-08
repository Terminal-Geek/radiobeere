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

<!--- Seiteninhalt --->

        <div data-role="main" class="ui-content">
	<h2>Hilfe</h2>

	<p>Hier kommen noch ganz viele sachdienliche Hinweise hin.</p>



       <div class="illu-content-wrapper">
        <div class="illu-content illu-help">
        </div></div>
        
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
