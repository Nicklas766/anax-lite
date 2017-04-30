<section>
<h3>Overview</h3>
</section>


<?php $res = $app->connect->getAllRes("SELECT * FROM ProductView"); ?>
<section>
<table>
<tr class="first">
<th> Edit </th>
<th> Prod_ID </th>
<th> In stock </th>
<th> Description </th>
<th> Category </th>
<th> Price </th>
<th> Img </th>
</tr>
<?php foreach ($res as $row) :?>

        <tr>
        <td>    <a href="<?= $app->url->create('webshop/edit')?>?id=<?= $row["id"] ?>"> Edit </a></td>
        <td> <?= $row["id"] ?> </td>
        <td><?= $row["InStock"] ?></td>
        <td> <?= $row["description"] ?> </td>
        <td> <?= $row["category"] ?> </td>
        <td> <?= $row["price"] ?> SEK </td>

        <td> <img src="<?= $row["image"] ?>" alt="notfound" height="42" width="42"> </td>
        </tr>

<?php endforeach; ?>

</table>
</section>
