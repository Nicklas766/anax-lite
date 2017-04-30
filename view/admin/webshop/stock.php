<div class="main">
<section>

<h1>Admin Dashboard</h1>
<p>This is the page for the warehouse</p>
<?= $app->navbar->getHTML(3); ?>
</section>


<?php $res = $app->connect->getAllRes("SELECT * FROM VInventory");
$resLow = $app->connect->getAllRes("SELECT * FROM LowStock"); ?>
<section>
<table>
    <tr class="first">
        <th> Edit </th>
        <th> Shelf </th>
        <th> PROD_ID </th>
        <th> Location </th>
        <th> Amount </th>
    </tr>
<?php foreach ($res as $row) :?>
        <tr>
        <td> <a href="<?= $app->url->create('webshop/editstock')?>?id=<?= $row["prod_id"] ?>"> Edit </a></td>
        <td> <?= $row["shelf"] ?> </td>
        <td> <?= $row["prod_id"] ?> </td>
        <td> <?= $row["location"] ?> </td>
        <td> <?= $row["amount"] ?></td>
        </tr>

<?php endforeach; ?>

</table>
</section>
