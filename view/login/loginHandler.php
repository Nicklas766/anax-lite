<?php
// Store all variables above
$db = $app->connect; // database class
$session = $app->session; // session class
$session->start(""); // start session

// If name doesn't exist, redirect to login
if (!$session->has("name")) {
    header("Location: $loginLink");
}

$user = $session->get("name");

// EDIT.php
// Check if form posted and get incoming
if (isset($_POST['save'])) {
    // Store posted form in parameter array
    $info = htmlentities($_POST['info']);
    $email = htmlentities($_POST['email']);

    $params = [$info, $email];
    // send params to database class
    $db->edit($params, $user);
}
