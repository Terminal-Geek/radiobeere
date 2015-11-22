<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RadioBeere - Neustart</title>
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

        <div data-role="main"
             class="ui-content">
            <h2>Neustart</h2>

            <?php
            if($_POST['reboot'] == "true")
                {
                echo "<p>Das System wird nun heruntergefahren und neu gestartet.
                In etwa zwei Minuten kannst du die <a href=\"/\">Startseite</a>
                der RadioBeere wieder aufrufen.</p>";
                exec("sudo reboot");
                }
            else
                {
                echo "<p>Das System wirklich herunterfahren und neu starten?</p>";
                echo "<br />";
                echo "<form method=\"post\">";
                echo "<button type=\"submit\" name=\"reboot\" value=\"true\">
                Neustart</button>";
                echo "</form>";
                }
            ?>

            <div class="illu-content-wrapper">
                <div class="illu-content illu-stations">
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
