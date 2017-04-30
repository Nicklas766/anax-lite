<?php
$resCat = $app->connect->getAllRes("SELECT * FROM ProdCategory");
$resImg = $app->connect->getAllRes("SELECT * FROM Image");
?>
<section>
    <h3>Create Product</h3>
</section>


<!-- Form -->
<div class="widget" style="height:100%;">
<div class="edit-container">
    <form method="post" style="width:100%; ">
        <label>Description</label>
        <input type='text' style="width:75%;" name='description' value=''/>

        <label>Image</label>
        <select style="width:75%;" name="img">
            <?php foreach ($resImg as $k) :?>
                <option value="<?= $k["link"] ?>"><?= $k["link"] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Price</label>
        <input type='number' style="width:75%;" name='price' value=''/>


        <p class='success' style="background:orange; font-size: 17px; padding:20px;">Choose one, you will be able to edit more later.</p>

        <?php foreach ($resCat as $k) :?>

            <?= $k["category"] ?><input style="width:100px;" type="radio" name="catId" value="<?= $k["id"] ?>">

        <?php endforeach; ?>


        <button type="submit" name="create"></i> Create</button>
    </form>
</div>
</div>
</div>
