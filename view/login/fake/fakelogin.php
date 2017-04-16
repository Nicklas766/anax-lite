<div class="main">
    <div style="width:50%; margin-left:auto; margin-right:auto; margin-top:100px;">
<?php
$session = $app->session;
// Make sure no one is logged in
$session->start(""); // start session

// Make sure no one is logged in
if ($session->has("name")) {
    echo "<p>You are already logged in as " . $session->get('name') . "</p>";
    echo "<p><a class='inactiveLink' href='logout.php'>Logout</a></p>";
    echo "<p>Go to profile <a class='inactiveLink' href='empty'>here.</a></p>";
}
$user_loggedin = "disabled";
?>
    <center>
        <form action="emtpy" method="POST">
            <label for="name">Enter name:</label>
            <input placeholder="Username" type="text" name="name" <?=$user_loggedin?>>

            <label for="new_pass">Password</label>
            <input placeholder="Password" type="password" name="pass" <?=$user_loggedin?>>

            <td><input type="submit" name="submitForm" value="Login" <?=$user_loggedin?>></td>

        </form>
</center>
 <a class="inactiveLink" href="emtpy">Create User</a>
</div></div>
