<div class='general-container'>
<h3>Add user</h3>
<p> You can add a new user here. </p>
<?php
$admin = $app->admin;

if (isset($_POST['submitCreateForm'])) {
    // Handle incoming POST variables
    $user_name = isset($_POST["new_name"]) ? htmlentities($_POST["new_name"]) : null;
    $user_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
    $re_user_pass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;
    $authority = isset($_POST["authority"]) ? htmlentities($_POST["authority"]) : null;

    // Check if username exists
    if (!$admin->exists($user_name)) {
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
                $admin->addUser($user_name, $crypt_pass, $authority);

                echo "<p class='success'>Successfully added " . $user_name . "!</p>";
                $admin->searchUser($user_name);
            }
        }
    } else {
        echo "<p class='warning'>User already exists! Choose another username.</p>";
    }
}
?>
    <form action="" method="POST">
        <fieldset>
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
</fieldset>
    </form>

</div></div></div>
