<?php
// Store all variables above
$db = $app->connect; // database class
$session = $app->session; // session class
$session->start("");

// Handle incoming POST variables
$user_name = isset($_POST["name"]) ? htmlentities($_POST["name"]) : null;
$user_pass = isset($_POST["pass"]) ? htmlentities($_POST["pass"]) : null;


// Correspond according to input
// Check if both fields are filled
if ($user_name != null && $user_pass != null) {
    // Check if username exists
    if ($db->exists($user_name)) {
        $get_hash = $db->getHash($user_name);
        // Verify user password
        if (password_verify($user_pass, $get_hash)) {
            $session->set("name", $user_name);
            header("Location: $profileLink");
        } else {
            // Redirect to login.php
            echo "User name or password is incorrect. <a href='$loginLink'>Try again.</a>";
        }
    } else {
        // Redirect to login.php
        echo "No such user. <a href='$loginLink'>Try again.</a>";
    }
}
