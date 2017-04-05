    <h1></h1>
    <?php
    // Starta sessionen
    $app->session->start("");

    // Does calendar exist in session?
    if ($app->session->has("calendar")) {
        $calendar = $app->session->get("calendar");
    } else {
        $app->session->set("calendar", $app->calendar);
        $calendar = $app->session->get("calendar");
    }

    if (isset($_POST['submit'])) {
        $calendar->nextMonth();
        header("Location: $redirect");
        exit;
    }

    if (isset($_POST['submit2'])) {
        $calendar->previousMonth();
        header("Location: $redirect");
        exit;
    }


        $calendar->showCal();
        echo "<form name='input' method='post'>";
        echo "<input type='submit' class='triangle' name='submit2' value='Förra'>";
        echo " ";
        echo "<input type='submit' class='triangle2' name='submit' value='Nästa'>";
        echo "</form>";
?>
