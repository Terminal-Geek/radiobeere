<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>RadioBeere - Aufnahme planen</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <?php
    include("include/styling.php");
    ?>
    <link rel="stylesheet"
          href="/js/pickadate.js-3.5.6/lib/themes/default.css"
          id="theme_base" />
    <link rel="stylesheet"
          href="/js/pickadate.js-3.5.6/lib/themes/default.date.css"
          id="theme_date" />
</head>

<body>

    <?php
    $alias = $_POST["alias"];
    ?>

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

        <div data-main-role="main"
             class="ui-content">
            <h2>Aufnahme planen</h2>

            <h3>Eine einzelne Sendung aufnehmen</h3>

            <p>Planst du eine einzelne Aufnahme ohne Wiederholungstermine? Dann
            wähle ein Datum und klicke auf "Nächster Schritt". Wenn du eine
            Sendung wiederholt aufnehmen möchtest, zum Beispiel deine tägliche
            Lieblingssendung, dann lasse das Datumsfeld frei und gib
            stattdessen die Wochentage für deine Serienaufnahme an.</p>

            <form action="record3.php"
                  method="post">

                <?php
                echo "<input type=\"hidden\" name=\"alias\" value=\"$alias\">";
                ?>

                <input type="text"
                      id="datepicker"
                      name="datum"
                      class="datepicker"
                      placeholder="Datum wählen" /><br />
                <br />
                <button type="submit"
                      name="submit">Nächster Schritt</button><br />
                <br />

                <h3>Serienaufnahme</h3>

                <p>Wähle die Wochentage, an denen du eine bestimmte Sendung
                regelmäßig aufnehmen möchtest. Im nächsten Schritt kannst du
                Sendezeit und Länge eingeben.</p>
                <br />

                <fieldset>
                    <label for="check1"><input type="checkbox"
                           name="wochentage[]"
                           value="1"
                           id="check1" /> Montag</label>
                    <label for="check2"><input type="checkbox"
                           name="wochentage[]"
                           value="2"
                           id="check2" /> Dienstag</label>
                    <label for="check3"><input type="checkbox"
                           name="wochentage[]"
                           value="3"
                           id="check3" /> Mittwoch</label>
                    <label for="check4"><input type="checkbox"
                           name="wochentage[]"
                           value="4"
                           id="check4" /> Donnerstag</label>
                    <label for="check5"><input type="checkbox"
                           name="wochentage[]"
                           value="5"
                           id="check5" /> Freitag</label>
                    <label for="check6"><input type="checkbox"
                           name="wochentage[]"
                           value="6"
                           id="check6" /> Samstag</label>
                    <label for="check7"><input type="checkbox"
                           name="wochentage[]"
                           value="0"
                           id="check7" /> Sonntag</label>
                </fieldset>
                <br />
                <br />
                <button type="submit"
                      name="submit">Nächster Schritt</button>
            </form>

            <div class="illu-content-wrapper">
                <div class="illu-content illu-record">
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
    <script src="/js/pickadate.js-3.5.6/lib/picker.js">
    </script>
    <script src="/js/pickadate.js-3.5.6/lib/legacy.js">
    </script>
    <script src="/js/pickadate.js-3.5.6/lib/picker.date.js">
    </script>
    <script src="/js/pickadate.js-3.5.6/lib/translations/de_DE.js">
    </script>
    <script type='text/javascript'>
    //<![CDATA[
    $(function() {
    $('.datepicker').pickadate({
    firstDay: 1,
    format: 'dd.mm.yyyy'
    });
    });
    //]]>
    </script>
</body>
</html>
