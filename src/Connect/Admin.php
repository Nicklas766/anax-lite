<?php
/**
 * Admin
 */
namespace nicklas\Connect;

use \PDO;

class Admin extends Connect implements \Anax\Common\AppInjectableInterface, \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait,
        \Anax\Common\AppInjectableTrait;


    private $currentUrl = "";

    public function __construct()
    {
        parent::__construct();
    }

    public function adminControl($user)
    {
        $stmt = $this->db->prepare("SELECT authority FROM users WHERE name='$user'");
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res["authority"] == "Admin") {
            return true;
        }
        return false;
    }

    public function setApp($app)
    {
        $this->app = $app;
        $this->currentUrl = $app->request->getRoute();
    }

    public function getMax($hits)
    {

        $max = $this->db->query("SELECT COUNT(id) FROM users")->fetchColumn();
        $max = ceil($max / $hits);
        return $max;
    }

    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id='$id'");
        $stmt->execute();
    }
    public function setUser($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id='$id'");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->setUserTable($res);
        $this->setUserForm($res);
    }
    public function editUser($params, $id)
    {
        // Prepare SQL statement to UPDATE a row in the table
        $stmt = $this->db->prepare("UPDATE users SET info = ?, email = ?, authority = ? WHERE id='$id'");
        // Execute the SQL to Update
        $stmt->execute($params);
    }
    public function searchUser($search)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE name LIKE '$search'");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->setTable($res);
    }

    public function setAllTables($hits, $offset, $orderBy, $order)
    {

        $stmt = $this->db->prepare("SELECT * FROM users ORDER BY $orderBy $order LIMIT $hits OFFSET $offset");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->setTable($res);
    }

    public function orderby($column)
    {
        if (strpos($this->app->request->getRoute(), 'search') !== false) {
            return;
        }
        $asc = $this->mergeQueryString(["orderby" => $column, "order" => "asc"]);
        $desc = $this->mergeQueryString(["orderby" => $column, "order" => "desc"]);

        return <<<EOD
<span class="orderby">
<a href="$asc">&darr;</a>
<a href="$desc">&uarr;</a>
</span>

EOD;
    }

    public function mergeQueryString($options, $prepend = "?")
    {
        // Parse querystring into array
        $query = [];
        parse_str($_SERVER["QUERY_STRING"], $query);

        // Merge query string with new options
        $query = array_merge($query, $options);

        // Build and return the modified querystring as url
        return $prepend . http_build_query($query);
    }

    public function setTable($res)
    {
        //loop through array, put data into table rows
        $rows = null;
        foreach ($res as $row) {
            $id1 = htmlentities($row['id']);
            $rows .= "<tr>";
            $rows .= "<td><a href='{$this->app->url->create('edituser')}?id=$id1'>Edit</a></td>";
            $rows .= "<td>" . $row['id'] . "</td>";
            $rows .= "<td>" . $row['name'] . "</td>";
            $rows .= "<td>" . $row['email'] . "</td>";

            $rows .= "<td>" . $row['info'] . "</td>";
            $rows .= "<td>" . $row['authority'] . "</td>";

            $rows .= "</tr>\n";
        }

        $th1 = "<th>ID" . $this->orderby("id") . "</th>";
        $th1 .= "<th>User" . $this->orderby("name") . "</th>";
        $th1 .= "<th>Email" . $this->orderby("email") . "</th>";
        $th1 .= "<th>Info" . $this->orderby("info") . "</th>";
        $th1 .= "<th>Authority" . $this->orderby("authority") . "</th>";
        //print out result as a html table using php heredoc
        echo<<<EOD
<table>
<tr>
<th>Profile</th>
$th1
</tr>
$rows
</table>

EOD;
    }

    public function setUserForm($res)
    {
        //loop through array, put data into table rows
        $rows = null;
        foreach ($res as $row) {
            $id1 = htmlentities($row['id']);
            $rows .= "<label for='info'>info</label>";
            $rows .= "<textarea rows='4' cols='50' name='info'>" . $row['info'] . "</textarea>";

            $rows .= "<label for='email'>email</label>";
            $rows .= "<textarea rows='4' cols='50' name='email'>" . $row['email'] . "</textarea>";
        }
        //print out result as a html table using php heredoc
        echo<<<EOD
<div class="edit-div">
<form action="{$this->app->url->create('edituser')}?id=$id1" method="POST">
<legend><h3>Edit Profile</h3></legend>
$rows
<label for="authority">Authority</label>
<select name="authority">
    <option></option>
    <option>User</option>
    <option>Admin</option>
</select>
<input type="submit" name="save" value="Update">
</form>
</div>

<div class="delete-div">
<form action="{$this->app->url->create('edituser')}?id=$id1" method="POST">
<legend><h3>Delete Profile</h3></legend>
<input placeholder="Type delete" type="text" name="deleteTyped">
<input type="submit" name="delete" value="Delete">
</form>
    </div>
    <div class="password-div">
<form action="{$this->app->url->create('edituser')}?id=$id1" method="POST">

    <legend><h3>Change Password</h3></legend>

<input placeholder="Password" type="text" name="new_pass">
<input type="submit" name="changePass" value="Change password">
    </form>
    </div>
EOD;
    }
    public function setUserTable($res)
    {
        //loop through array, put data into table rows
        $rows = null;
        foreach ($res as $row) {
            $rows .= "<tr>";
            $rows .= "<th>User</th>";
            $rows .= "<td>" . $row['name'] . "</td>";
            $rows .= "</tr><tr>";

            $rows .= "<th>Email</th>";
            $rows .= "<td>" . $row['email'] . "</td>";

            $rows .= "</tr><tr>";

            $rows .= "<th>Info</th>";
            $rows .= "<td>" . $row['info'] . "</td>";

            $rows .= "</tr><tr>";

            $rows .= "<th>Authority</th>";
            $rows .= "<td>" . $row['authority'] . "</td>";
            $rows .= "</tr>\n";
        }
        //print out result as a html table using php heredoc
        echo<<<EOD
<div class="user-div">
<h3> User information </h3>
<table>
$rows
</table>
</div>

EOD;
    }
}
