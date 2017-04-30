<?php
/**
 * Login Routes.
 */

 // KOM03 ADMIN


// -------------------------------------------------------
//                  MAIN
// -------------------------------------------------------
$app->router->add("admin", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Login"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin", [
     "failLink" => $app->url->create("admin/fail")
    ]);
    $app->response->setBody([$app->view, "render"])
        ->send();
});

// -------------------------------------------------------
//  FAIL
// -------------------------------------------------------

$app->router->add("admin/fail", function () use ($app) {
    $app->renderPage("admin/user/fail", "Fail");
});

// -------------------------------------------------------
//  EDIT USER
// -------------------------------------------------------
$app->router->add("edituser", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Login"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin", [
     "failLink" => $app->url->create("admin/fail")
    ]);
    $app->view->add("edituser", [
     "usersLink" => $app->url->create("admin/users")
    ]);
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


// -------------------------------------------------------
//  USERS
// -------------------------------------------------------

$app->router->add("admin/users", function () use ($app) {
    $app->view->add("session/header", ["title" => "Login"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin", [
     "failLink" => $app->url->create("admin/fail")
    ]);
    $app->view->add("admin/user/users");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});
// -------------------------------------------------------
//  SEARCH USER
// -------------------------------------------------------

$app->router->add("admin/search", function () use ($app) {
    $app->view->add("session/header", ["title" => "Login"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin", [
     "failLink" => $app->url->create("admin/fail")
    ]);
    $app->view->add("admin/user/search", [
     "searchLink" => $app->url->create("admin/search")
    ]);
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});

// -------------------------------------------------------
//  ADD USER
// -------------------------------------------------------

$app->router->add("admin/add", function () use ($app) {
    $app->view->add("session/header", ["title" => "Login"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin", [
     "failLink" => $app->url->create("admin/fail")
    ]);
    $app->view->add("admin/user/add");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});




// -------------------------------------------------------
//  KOM04
// -------------------------------------------------------


$app->router->add("textfilter", function () use ($app) {
    $app->renderPage("textfilter", "createcontent");
});

$app->router->add("pages", function () use ($app) {
    $app->view->add("take1/header", ["title" => "pages"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin/content/pages", [
     "pageLink" => $app->url->create("page")
    ]);
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});

$app->router->add("page", function () use ($app) {
    $app->renderPage("admin/content/page", "page");
});

$app->router->add("blog/**", function () use ($app) {
    $app->renderPage("admin/content/blog", "Blog");
});


$app->router->add("admin/create", function () use ($app) {
    $app->view->add("session/header", ["title" => "createcontent"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin", [
     "failLink" => $app->url->create("admin/fail")
    ]);
    $app->view->add("admin/content/create");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("admin/overview", function () use ($app) {
    $app->view->add("session/header", ["title" => "overviewcontent"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin", [
     "failLink" => $app->url->create("admin/fail")
    ]);
    $app->view->add("admin/content/overview");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});


$app->router->add("admin/edit", function () use ($app) {
    $app->view->add("session/header", ["title" => "editcontent"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin", [
     "failLink" => $app->url->create("admin/fail")
    ]);
    $app->view->add("admin/content/edit");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});

$app->router->add("notfound", function () use ($app) {
    $app->renderPage("admin/content/404", "notfound");
});
