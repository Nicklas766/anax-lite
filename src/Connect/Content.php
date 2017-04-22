<?php
/**
 * Content
 */
namespace nicklas\Connect;

use \PDO;

class Content extends Connect implements \Anax\Common\AppInjectableInterface, \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait,
        \Anax\Common\AppInjectableTrait;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Adds title to the database, in order to make it editable
     * @param $title contains the title
     * @return void
     */

    public function slugExists($slug, $id)
    {
         $stmt = $this->db->prepare("SELECT * FROM content WHERE slug='$slug' AND id<>'$id'");
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
         return !$row ? false : true;
    }
    public function pathExists($path, $id)
    {
         $stmt = $this->db->prepare("SELECT * FROM content WHERE path='$path' AND id<>'$id'");
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
         return !$row ? false : true;
    }
     /**
      * Return last insert id from an INSERT.
      *
      * @return void
      */
    public function lastInsertId()
    {
         return $this->db->lastInsertId();
    }

    public function setApp($app)
    {
        $this->app = $app;
        $this->currentUrl = $app->request->getRoute();
    }
    public function createContent($title)
    {
        $stmt = $this->db->prepare("INSERT into content (title) VALUES ('$title')");
        $stmt->execute();
    }

    /**
     * Adds content to the database based on ID
     * @param $id contains the id
     * @return void
     */
    public function editContent($params)
    {
        // Prepare SQL statement to UPDATE a row in the table
        $stmt = $this->db->prepare("UPDATE content SET title = ?, path = ?, slug = ?, data = ?, type = ?, filter = ?, published = ?, updated=NOW() WHERE id = ?");
        // Execute the SQL to Update
        $stmt->execute($params);
    }

    // Echo edit form. Uses ID
    public function deleteContent($id)
    {
        $stmt = $this->db->prepare("UPDATE content SET deleted=NOW() WHERE id = '$id';");
        $stmt->execute();
    }

    // gets overview of table.
    public function getTableContent()
    {
        $stmt = $this->db->prepare("SELECT * FROM content");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->setTableContent($res);
    }

     // Echo edit form. Uses ID
    public function getEditForm($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM content WHERE id = '$id';");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->setEditForm($res);
    }

    public function orderby($column)
    {
        if (strpos($this->app->request->getRoute(), 'search') !== false) {
            return;
        }
        $asc = mergeQueryString(["orderby" => $column, "order" => "asc"]);
        $desc = mergeQueryString(["orderby" => $column, "order" => "desc"]);

        return <<<EOD
<span class="orderby">
<a href="$asc">&darr;</a>
<a href="$desc">&uarr;</a>
</span>

EOD;
    }

    public function setEditForm($res)
    {
        //loop through array, put data into submit
        $rows1 = null;
        $rows2 = null;
        $rows3 = null;
        foreach ($res as $row) {
            // ID as hidden input
            $rows1 .= "<input type='hidden' name='contentId' value='". $row['id'] ."'/>";
            // title, path, slug as text input
            $rows1 .= "<label>Title</label><input type='text' name='contentTitle' value='". $row['title'] ."'/>";
            $rows1 .= "<label>Path</label><input type='text' name='contentPath' value='". $row['path'] ."'/>";
            $rows1 .= "<label>Slug</label><input type='text' name='contentSlug' value='". $row['slug'] ."'/>";
            // textarea for the data (text).
            $rows2 .= "<label>Text</label><textarea style='height:400px;'name='contentData'>". $row['data'] ."</textarea>";
            // type, filter as input text and then datetime for "published".
            $rows3 .= "<label>Type</label><select name='contentType'>" .
            "<option>".$row['type']."</option><option>page</option><option>post</option><option>block</option></select>";
            $rows3 .= "<label>Filter</label><input type='text' name='contentFilter' value='". $row['filter'] ."'/>";
            $rows3 .= "<label>Published</label><input type='datetime' name='contentPublish' value='". $row['published'] ."'/>";
        }
        //print out result as a html table using php heredoc
        echo<<<EOD
<h3>Edit Content</h3>
<form method="post">

<div class="edit-container">
<div class="user-div">
$rows1
$rows3
</div>
<div class="edit-div">
$rows2
<button type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
<button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
</div>
</form>
</div>
EOD;
    }
    // uses $res to create HTML
    public function setTableContent($res)
    {
          //loop through array, put data into table rows
          $rows = null;
        foreach ($res as $row) {
              $id = htmlentities($row['id']);
              $rows .= "<tr>";
              $rows .= "<td><a href='{$this->app->url->create('admin/edit')}?id=$id'>Edit</a></td>";
              $rows .= "<td>" . $row['id'] . "</td>";
              $rows .= "<td>" . $row['title'] . "</td>";
              $rows .= "<td>" . $row['published'] . "</td>";
              $rows .= "<td>" . $row['created'] . "</td>";
              $rows .= "<td>" . $row['updated'] . "</td>";
              $rows .= "<td>" . $row['deleted'] . "</td>";
              $rows .= "<td>" . $row['path'] . "</td>";
              $rows .= "<td>" . $row['slug'] . "</td>";
              $rows .= "</tr>\n";
        }

          $th1 = "<th>   |ID</th>";
          $th1 .= "<th>Title</th>";
          $th1 .= "<th>Published</th>";
          $th1 .= "<th>Created</th>";
          $th1 .= "<th>Updated</th>";
          $th1 .= "<th>Deleted</th>";
          $th1 .= "<th>Path</th>";
          $th1 .= "<th>Slug</th>";
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
}
