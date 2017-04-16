<?php
/**
 * Login Routes.
 */

 // KOM03 LOGIN


// -------------------------------------------------------
//                  MAIN
// -------------------------------------------------------
$app->router->add("login", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Login"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("login", [
     "logoutLink" => $app->url->create("login/logout"),
     "createLink" => $app->url->create("login/create_user"),
     "validateLink" => $app->url->create("login/validate"),
     "profileLink" => $app->url->create("login/profile")
    ]);
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
        ->send();
});
// -------------------------------------------------------
//  CREATE
// -------------------------------------------------------
$app->router->add("login/create_user", function () use ($app) {
    $app->view->add("session/header", ["title" => "CreateUser"]);
    $app->view->add("navbar2/navbar");

    $app->view->add("login/create/create_user", [
     "loginLink" => $app->url->create("login"),
     "create_userLink" => $app->url->create("login/create_user")
    ]);
    $app->view->add("login/fake/fakelogin");
    $app->view->add("take1/footer");
        $app->response->setBody([$app->view, "render"])
      ->send();
});

// -------------------------------------------------------
//  VALIDATE LOGIN
// -------------------------------------------------------
$app->router->add("login/validate", function () use ($app) {
    $app->view->add("login/validate", [
     "loginLink" => $app->url->create("login"),
     "profileLink" => $app->url->create("login/profile")
    ]);
        $app->response->setBody([$app->view, "render"])
      ->send();
});

// -------------------------------------------------------
//  USER PROFILE
// -------------------------------------------------------

$app->router->add("login/profile", function () use ($app) {
    $app->view->add("session/header", ["title" => "Profile"]);
    $app->view->add("navbar2/navbar");

    $app->view->add("login/loginHandler", [
        "loginLink" => $app->url->create("login")
     ]);

    $app->view->add("login/profile", [
    "adminLink" => $app->url->create("admin"),
     "loginLink" => $app->url->create("login"),
     "logoutLink" => $app->url->create("login/logout"),
     "editLink" => $app->url->create("login/edit"),
     "changePasswordLink" => $app->url->create("login/change_password")
    ]);
    $app->view->add("take1/footer");
        $app->response->setBody([$app->view, "render"])
      ->send();
});

// -------------------------------------------------------
//  EDIT PROFILE
// -------------------------------------------------------

$app->router->add("login/edit", function () use ($app) {
    $app->view->add("session/header", ["title" => "Profile"]);
    $app->view->add("navbar2/navbar");

    $app->view->add("login/loginHandler", [
        "loginLink" => $app->url->create("login")
     ]);

    $app->view->add("login/edit", [
     "editLink" => $app->url->create("login/edit"),
     "profileLink" => $app->url->create("login/profile"),
     "loginLink" => $app->url->create("login")
    ]);
    $app->view->add("take1/footer");
        $app->response->setBody([$app->view, "render"])
        ->send();
});

// -------------------------------------------------------
//                 LOGOUT
// -------------------------------------------------------

$app->router->add("login/logout", function () use ($app) {
    $app->view->add("session/header", ["title" => "Profile"]);
    $app->view->add("navbar2/navbar");

    $app->view->add("login/logout", [
     "loginLink" => $app->url->create("login"),
    ]);
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
    ->send();
});
// -------------------------------------------------------
//                 CHANGE PASSWORD // -------------------------------------------------------

$app->router->add("login/change_password", function () use ($app) {
    $app->view->add("session/header", ["title" => "Profile"]);
    $app->view->add("navbar2/navbar");

    $app->view->add("login/loginHandler", [
        "loginLink" => $app->url->create("login")
     ]);

    $app->view->add("login/change_password", [
     "loginLink" => $app->url->create("login"),
     "logoutLink" => $app->url->create("login/logout"),
     "profileLink" => $app->url->create("login/profile"),
     "changePasswordLink" => $app->url->create("login/change_password")
    ]);
    $app->view->add("login/fake/fakeprofile");

    $app->view->add("take1/footer");
             $app->response->setBody([$app->view, "render"])
                ->send();
});
