<div class="submitBox">
<?php
$db = $app->connect;
$session = $app->session;

$user_loggedin = "";

if (isset($_POST['submitCreateForm'])) {
    // Handle incoming POST variables
    $user_name = isset($_POST["new_name"]) ? htmlentities($_POST["new_name"]) : null;
    $user_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
    $re_user_pass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;
    $authority = isset($_POST["authority"]) ? htmlentities($_POST["authority"]) : null;

    // Check if username exists
    if (!$db->exists($user_name)) {
        // Check passwords match
        if ($user_pass != $re_user_pass) {
            echo "<p class='warning'>Passwords do not match!</p>";
        } else {
            if (strpos($user_name, '%') !== false) {
                echo "<p class='warning'>% is not an acceptable character.</p>";
            } else {
                // Make a hash of the password
                $crypt_pass = password_hash($user_pass, PASSWORD_DEFAULT);

                // Add user to database
                $db->addUser($user_name, $crypt_pass, $authority);

                echo "<p class='success'>Successfully added " . $user_name . "!</p>";
            }
        }
    } else {
        echo "<p class='warning'>User already exists! Choose another username.</p>";
    }
}
?>

    <form action="<?= $create_userLink ?>" method="POST">

            <legend><h3>Create user</h3></legend>
                <label for="new_name">Username</label>
                <input placeholder="Username" type="text" name="new_name">

                <label for="new_pass">Password</label>
                <input placeholder="Password" type="password" name="new_pass">


                <label for="re_pass">Repeat password</label>
                <input  placeholder="Password"type="password" name="re_pass">


                <label for="authority">Authority</label>
                <select name="authority">
                    <option></option>
                    <option>User</option>
                    <option>Admin</option>
                </select>


                <input type="submit" name="submitCreateForm" value="Create">

    </form>
    <p><a href="<?= $loginLink ?>">Back to login</a></p>

</div>

<?php
echo '<div style="background:black; opacity: 0.2;">';
