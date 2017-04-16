<div class='general-container'>
<h3>Search</h3>
<p> You can search for a user here. </p>

<form action="<?= $searchLink ?>" method="POST">
<input name="search" value="" placeholder="Search User">
<input type="submit" value="Search">
</form>

<?php
$admin = $app->admin;
// Check if form posted and get incoming
if (isset($_POST['search'])) {
    // Store posted form in parameter array
    $search = htmlentities($_POST['search']);

    // send search to admin class
    $admin->searchUser($search);
}

echo "</div></div></div>";
