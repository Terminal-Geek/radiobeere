<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RadioBeere</title>
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
        </div>

        <div data-role="main"
             class="ui-content"
             style="max-width:1024px !important; text-align:center">
            <a href="record.php">
            <div class=
            "hp-wrapper ui-btn ui-input-btn ui-shadow ui-btn-inline">
                <div class="hp-button record">
                </div>
                Planen
            </div></a> <a href="timer.php">
            <div class=
            "hp-wrapper ui-btn ui-input-btn ui-shadow ui-btn-inline">
                <div class="hp-button timer">
                </div>
                Timer
            </div></a> <a href="aufnahmen.php">
            <div class=
            "hp-wrapper ui-btn ui-input-btn ui-shadow ui-btn-inline">
                <div class="hp-button player">
                </div>
                Player
            </div></a> <a href="podcast.php">
            <div class=
            "hp-wrapper ui-btn ui-input-btn ui-shadow ui-btn-inline">
                <div class="hp-button podcast">
                </div>
                Podcast
            </div></a> <a href="streaming.php">
            <div class=
            "hp-wrapper ui-btn ui-input-btn ui-shadow ui-btn-inline">
                <div class="hp-button streaming">
                </div>
                Streaming
            </div></a> <a href="stations.php">
            <div class=
            "hp-wrapper ui-btn ui-input-btn ui-shadow ui-btn-inline">
                <div class="hp-button stations">
                </div>
                Sender
            </div></a> <a href="help.php">
            <div class=
            "hp-wrapper ui-btn ui-input-btn ui-shadow ui-btn-inline">
                <div class="hp-button help">
                </div>
                Hilfe
            </div></a> <a href="maintenance.php">
            <div class=
            "hp-wrapper ui-btn ui-input-btn ui-shadow ui-btn-inline">
                <div class="hp-button maintenance">
                </div>
                Wartung
            </div></a> <a href="reboot.php">
            <div class=
            "hp-wrapper ui-btn ui-input-btn ui-shadow ui-btn-inline">
                <div class="hp-button reboot">
                </div>
                Neustart
            </div></a>
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
