<h1>Session</h1>
<p>Sessions-uppgiften för OOPHP kmom02.</p>
<?php

// Starta sessionen
$app->session->start("");

// Does number exist in session?
if ($app->session->has("number")) {
    echo "<h1>" . $app->session->get("number") . "</h1>";     // Skriver ut "Urkel"
} else {
    $app->session->set("number", 0);
    echo "<h1>" . $app->session->get("number") . "</h1>";
}

// Get session navbar
echo $app->navbar->getHTML(1);
?>
