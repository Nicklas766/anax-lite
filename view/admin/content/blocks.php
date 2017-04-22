<?php
$block = $app->block;

$resultset = $block->getResultSet();
if (!$resultset) {
    return;
}
?>
<center><h1> More News (block) (won't work without path) </h1></center>
<div class="flex-container">
<!-- // idén är att en flex-container med widget av typen "block" är på längst ner på huvudsidan. -->
    <?php $id = -1; foreach ($resultset as $row) :
        $id++;
        $posted = "False";
        if (new DateTime() > new DateTime(esc($row["published"]))) {
            $posted = "True";
        }
    ?>
            <div class="widget"><a href="<?=$pageLink?>?path=<?= $row["path"] ?>"><?= esc($row["title"]) ?></a>
            <p>Published:<?= esc($posted) ?></p>
            <p>Path:<?= esc($row["path"]) ?></p>

            </div>


    <?php endforeach; ?>
</div>
