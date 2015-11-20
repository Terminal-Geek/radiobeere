<!DOCTYPE html>
<html>
<head>
<title>RadioBeere - Wartung</title>

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
<a href="/" data-icon="home" data-iconpos="notext">Startseite</a>
</div>

<div data-role="main" class="ui-content">

<h2>Update</h2>

<?php

if($_POST['update'] == "true")
{
echo "<p><strong>Die Software wird nun aktualisiert ...</strong></p>";
exec("sudo /home/pi/radiobeere/setup/update-radiobeere");
$logfile = file("radiobeere-update.log");
foreach ($logfile AS $logfile_output)
{
echo $logfile_output."<br />";
}
echo "<p><strong>Fertig!</strong></p>";
unset($_POST);
}

$version_url = "https://raw.githubusercontent.com/Terminal-Geek/radiobeere/master/var/www/version.txt";
$version_remote = file_get_contents($version_url);
$version_file = fopen("version.txt","r");
$version_local = fgets($version_file);
fclose($version_file);

if($version_remote > $version_local)
{
echo "<p>Es gibt eine neuere Version der RadioBeere-Software. Willst du aktualisieren?</p>";
echo "<form method=\"post\">";
echo "<button type=\"submit\" name=\"update\" value=\"true\">Update starten</button>";
echo "</form>";
}
else
{
echo "<p>Deine RadioBeere-Software ist auf dem aktuellen Stand.</p>";
}        

echo "Installierte Version:<br />";
echo date("d.m.Y, H:i:s", $version_local)." Uhr";

if($version_remote > $version_local)
{
echo "<br /><br />";
echo "Aktuelle Version auf dem Server:<br />";
echo date("d.m.Y, H:i:s", $version_remote)." Uhr";
}

?>

<h2>Freier Speicherplatz</h2>

<?php
$free = number_format(((disk_free_space("/")) / 1073741824), $decimals = "2");
echo $free." Gigabyte";
?>

<h2>System-Update-Protokoll</h2>

<p>Die Länge der Log-Datei ist auf 1.000 Zeichen begrenzt.</p>

<a href="dist-upgrade.log" target="_blank" class="ui-btn">Log-Datei ansehen</a>

<div class="illu-content-wrapper">
<div class="illu-content illu-maintenance">
</div>
</div>

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
