<?php
// Store all variables above
$db = $app->connect; // database class
$session = $app->session; // session class
$user = $session->get("name");
$status = "Change password";
$profileInfo = $db->getInfo($user); // Get current info from database class
?>

<div class='main'>
<div style="width:50%; margin-left:auto; margin-right:auto; margin-top:100px;">
    <form action="<?= $editLink ?>" method="POST">

        <legend><h3>Edit Profile</h3></legend>

            <label for="info">info</label>
            <textarea rows="4" cols="50" name="info"><?= $profileInfo[0] ?></textarea>

            <label for="email">email</label>
            <textarea rows="4" cols="50" name="email"><?= $profileInfo[1] ?></textarea>

            <input type="submit" name="save" value="Update">

    </form>
    <a href="<?= $profileLink ?>">Go back to profile</a>
</div></div>
