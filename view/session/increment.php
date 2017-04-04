<p> increment </p>

<?php

// Starta sessionen
$app->session->start();
$app->session->set("number", $app->session->get("number") + 1);

header("Location: $redirect");
