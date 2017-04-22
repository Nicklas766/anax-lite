<?php

$blog = $app->blog;
echo '<div class="main">';
// control if its slug, then get the post
if (substr($app->request->getRoute(), 0, 5) === "blog/") {
    echo "<h1>Blogpost</h1>";
    echo "<section>";
    $slug = substr($app->request->getRoute(), 5);
    $resultset = $blog->getBlogPost($slug);
    if (!$resultset) {
         header("Location: {$app->url->create('notfound')}");
         break;
    }
    $blog->showPost($resultset);
    echo "</section>";
// ELSE show entire blog
} else {
    echo "<h1>Blog</h1>";
    $resultset = $blog->getBlog();
    $blog->showBlog($resultset);
}
echo "</div>";
