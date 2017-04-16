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
    $app->view->add("session/header", ["title" => "Login"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin/fail");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});

// -------------------------------------------------------
//  EDIT USER
// -------------------------------------------------------
$app->router->add("edituser", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Login"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("admin");
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
    $app->view->add("admin");
    $app->view->add("admin/users");
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
    $app->view->add("admin");
    $app->view->add("admin/search", [
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
    $app->view->add("admin");
    $app->view->add("admin/add");
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});
