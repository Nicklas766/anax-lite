<?php
$page = $app->page;

$resultset = $page->getResultSet();

if (!$resultset) {
    return;
}
?>
<div class="main">
<section>
    <table>
        <tr class="first">
            <th>Id</th>
            <th>Title</th>
            <th>Type</th>
            <th>Status</th>
            <th>Published</th>
            <th>Deleted</th>
        </tr>
    <?php $id = -1; foreach ($resultset as $row) :
        $id++;
    ?>
        <tr>
            <td><?= $row["id"] ?></td>
            <td><a href="<?=$pageLink?>?path=<?= $row["path"] ?>"><?= esc($row["title"]) ?></a></td>
            <td><?= esc($row["type"]) ?></td>
            <td><?= esc($row["status"]) ?></td>
            <td><?= esc($row["published"]) ?></td>
            <td><?= esc($row["deleted"]) ?></td>
        </tr>
    <?php endforeach; ?>
    </table>

</section>
    </div>
