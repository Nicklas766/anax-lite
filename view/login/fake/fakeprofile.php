<?php

$session = $app->session;

echo "<div class='main'>";
// Resten av sidan
echo "<h1>Welcome!</h1>";

echo "<p>You are logged in as " . $session->get('name') . "</p>";

// echo "<p><a href='info.php'>View session</a></p>";

echo "<p><a class='inactiveLink' href='empty'>Logout</a></p>";

echo "<p><a  class='inactiveLink' href='emtpy'>Change password</a></p>";

echo "</div>";
