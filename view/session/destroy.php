<div class="main">

<article>
    <p> destroy </p>

<?php

// Starta sessionen
$app->session->start();
$app->session->destroy();

header("Location: $redirect");
