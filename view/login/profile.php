<?php
// Store all variables above
$db = $app->connect; // database class
$session = $app->session; // session class
$admin = $app->admin; // admin class
$user = $session->get("name");
$profileInfo = $db->getInfo($user);
?>
<div class='main'>

<h1>Welcome!</h1>

<p>You are logged in as <strong><?= $session->get('name') ?></strong></p>

<div class="profile">
    <p> Profile for <?= $user ?> </p>

    <label for="info">Personal info</label>
    <div class="info"> <?= $profileInfo[0] ?> </div>

    <label for="email">Email</label>
    <div class="info"> <?= $profileInfo[1] ?> </div>

    <label for="Authority">Authority</label>
    <div class="info"> <?= $profileInfo[2] ?> </div>

</div>
<?php
// set the cookies
setcookie("cookie1", "Lastest visit was " . date('Y/m/d'));
// after the page reloads, print them out
if (isset($_COOKIE['cookie1'])) {
        echo '<p>' . $_COOKIE["cookie1"] . "</p>";
}

// Links for profile. Show admin tools if admin logged in.
echo "<p><a style='float:right;' href='$logoutLink'>Logout</a></p>";
if ($admin->adminControl($user)) {
    echo "<p><a style='float:left;' href='$adminLink'>Admin Tools</a></p>";
}
echo "<p><a style='float:right; margin-right:20px;' href='$changePasswordLink'>Change password</a></p>";
echo "<p><a style='float:left; margin-left:20px; ' href='$editLink'>Edit Profile</a></p>";
echo "</div>";
