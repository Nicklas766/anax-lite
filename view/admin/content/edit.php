<?php
$content = $app->content;
// GET ID FIRST


$contentId = getPost("contentId") ?: getGet("id");
if (!is_numeric($contentId)) {
    die("Not valid for content id.");
}
echo "<div class='general-container'>";
if (hasKeyPost("doDelete")) {
    // kalla funktion istället
    $content->deleteContent($contentId);
    echo "<p class='warning'>You deleted this content</p>";
}
// Check if form posted and get incoming
if (hasKeyPost("doSave")) {
    // Store posted form in parameter array
    $params = getPost([
        "contentTitle",
        "contentPath",
        "contentSlug",
        "contentData",
        "contentType",
        "contentFilter",
        "contentPublish",
        "contentId"
    ]);
    if (!$params["contentSlug"]) {
        $params["contentSlug"] = slugify($params["contentTitle"]);
    }
    // if slug already exists with different id, stop submit
    if ($content->slugExists($params["contentSlug"], $params["contentId"])) {
        echo "<p class='warning'>Slug already exists, please enter new slug or title</p>";
        $content->getEditForm($contentId);
        die();
    }
    // if path already exists with different id, stop submit
    if ($content->pathExists($params["contentPath"], $params["contentId"])) {
        echo "<p class='warning'>Path already exists, please enter new path or nothing</p>";
        $content->getEditForm($contentId);
        die();
    }
    if (!$params["contentPath"]) {
        $params["contentPath"] = null;
    }
    // send params to content class to update current stats
    $content->editContent(array_values($params));
    echo "<p class='success'>You updated the details!</p>";
}

// Set the submit form
$content->getEditForm($contentId);
echo "</div></div></div>";
