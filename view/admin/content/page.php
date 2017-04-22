<?php
$content = $app->content;
$page = $app->page;
$textfilter = $app->textfilter;
// Try matching content for type page and its path

// Get number of hits per page
$path = getGet("path");

$pageRes = $page->getPage($path);

if (!$pageRes) {
     header("Location: {$app->url->create('notfound')}");
     break;
}
?>
<div class="main">

<article>
    <header>
        <h1><?= esc($pageRes["title"]) ?></h1>
        <p><i>Latest update: <time datetime='<?= $pageRes["modified_iso8601"] ?>' pubdate><?= esc($pageRes["modified"]) ?></time></i></p>
    </header>
    <?= $textfilter->doFilter(esc($pageRes["data"]), esc($pageRes["filter"])) ?>
</article>
</div>
