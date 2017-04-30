<div class="main">
<?php
// Get current page
$id = getGet("id");
if (!(is_numeric($id))) {
    die("Not valid for id.");
}
$resCat = $app->connect->getAllRes("SELECT * FROM ProdCategory");

// Check if form posted and get incoming
if (hasKeyPost('doDelete')) {
    $app->webshop->deleteProduct($id);
}
// Check if form posted and get incoming
if (hasKeyPost('doSave')) {
    // get all categories posts
    $categories = [];
    foreach ($resCat as $k) {
        if (hasKeyPost($k["category"])) {
            array_push($categories, $k["id"]);
        }
    }
    // get all product info
    $params = getPost([
        "id",
        "price",
        "description",
        "img"
    ]);

    // if slug already exists with different id, stop submit
    if (!$categories) {
        echo "<p class='warning'>You need to add a category</p>";
    } else {
        // send params to webshop class and update
        $app->webshop->updateProduct($params, $categories);
        echo "<p class='success'>You updated the details!</p>";
    }
}

$res = $app->connect->getRes("SELECT * FROM ProductView WHERE id = $id");
$resCat = $app->connect->getAllRes("SELECT * FROM ProdCategory");
$resImg = $app->connect->getAllRes("SELECT * FROM Image");
?>

<section>
    <h1>Product Information</h1>
</section>

<!-- Information -->
<div class="widget" style="height:100%;">
    <div class="widget" style="height:100%;">
    <img src="../<?= $res["image"] ?>" alt="notfound" height="100" width="100">
    </div>
    <div class="widget" style="height:100%; font-size: 20px;">
    <i> Description: <?= $res["description"] ?> </i> <br>
    <i> Category: <?= $res["category"] ?> </i> <br>
    <i> Price: <?= $res["price"] ?> SEK</i> <br>
    <i> In Stock: <?= $res["InStock"] ?> </i> <br>
    </div>
</div>

<!-- Form -->
<div class="widget" style="height:100%;">
<div class="edit-container">
<div class="edit-div" style="background:#1e212a;">
<form method="post">
    <input type='hidden' name='id' value='<?= $id?>'/>

    <label>Pris</label>
    <input type='number' style="width:75%;" name='price' value='<?= $res["price"] ?>'/>

    <label>Image</label>
    <select style="width:75%;" name="img">
        <?php foreach ($resImg as $k) :?>
            <option value="<?= $k["link"] ?>"><?= $k["link"] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Beskrivning</label>
    <textarea name='description'><?= $res["description"] ?></textarea>


</div>

<div class="user-div" style="background:#1e212a;">

        <label>Kategori</label>
        <?php foreach ($resCat as $k) :?>
            <label><?= $k["category"] ?> </label><input type="checkbox" name="<?= $k["category"] ?>">
        <?php endforeach; ?>
        <button type="submit" name="doSave"></i> Save</button>
        <button type="submit" name="doDelete"></i> Delete</button>
    </form>
</div>
</div>
</div>
</div>
