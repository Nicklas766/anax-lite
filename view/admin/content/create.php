<?php
$content = $app->content;

if (hasKeyPost("doCreate")) {
    $title = getPost("contentTitle");
    $content->createContent($title);
    $id = $content->lastInsertId();
    header("Location: {$app->url->create('admin/edit')}?id=$id");
    exit;
}
echo "<div class='general-container'>";
?>
<h3> Create Content </h3>
<form method="post">
    <fieldset>
    <legend><h3>Create</h3></legend>

        <label>Title:<br>
        <input type="text" name="contentTitle" default="A Title"/>
        </label>

        <button type="submit" name="doCreate"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
    </fieldset>
</form>

</div></div></div>
