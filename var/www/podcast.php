<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RadioBeere - Podcast</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <?php
    include("include/styling.php");
    ?>
</head>

<body>
    <div data-role="page"
         class="ui-responsive-panel"
         id="panel"
         data-title="RadioBeere">

        <div data-role="header">
            <a href="#nav-panel"
                 data-icon="bars"
                 data-iconpos="notext">Menü</a>
            <h1>RadioBeere</h1>
            <a href="/"
                 data-icon="home"
                 data-iconpos="notext">Startseite</a>
        </div>

        <?php
        include("include/db-connect.php")
        ?>

        <div data-role="main"
             class="ui-content">
            <h2>Podcast</h2>

            <p>Abonniere deine eigenen Radio-Aufnahmen als Podcast. Sollte ein
            Klick auf den jeweiligen Link nicht automatisch dein
            Podcast-Programm öffnen, kopiere den Link und füge ihn in deinem
            Podcast-Programm von Hand ein. In iTunes zum Beispiel gehst du
            dafür in der Podcast-Ansicht auf <b>Ablage - &gt; Podcast
            abonnieren</b>.</p>

            <p>
            <?php
            $hostname = gethostname();
            $abfrage = "SELECT * FROM sender ORDER BY name";
            $ergebnis = mysql_query($abfrage);
            while($row = mysql_fetch_object($ergebnis))
                 {
                $feed = "http://$hostname/podcast/$row->alias.xml";
                echo "<b>$row->name:</b><br><a href=\"$feed\" target=\"_blank\">$feed</a><br><br>";
                }
            ?>
            </p>

            <div class="illu-content-wrapper">
                <div class="illu-content illu-podcast">
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