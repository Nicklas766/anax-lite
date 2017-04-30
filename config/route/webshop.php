<?php


$app->router->add("webshop/**", function () use ($app) {
    $app->session->start();
    if (!$app->session->has("name")) {
        $app->redirect("admin/fail");
    }
    $user = $app->session->get("name");

    if (!$app->admin->adminControl($user)) {
        $app->redirect("admin/fail");
    }
});

$app->router->add("webshop", function () use ($app) {
    $arrayPages = ["admin/webshop/dashboard", "admin/webshop/overview", "admin/webshop/create"];
    $app->renderPage($arrayPages, "webshop admin");
});

$app->router->add("webshop/edit", function () use ($app) {
    $app->renderPage("admin/webshop/edit", "webshop edit");
});

$app->router->add("webshop/stock", function () use ($app) {
    $arrayPages = ["admin/webshop/stock", "admin/webshop/lowstock"];
    $app->renderPage($arrayPages, "webshop stock");
});

$app->router->add("webshop/editstock", function () use ($app) {
    $arrayPages = ["admin/webshop/dashboard", "admin/webshop/editstock"];
    $app->renderPage($arrayPages, "webshop edit");
});

$app->router->add("webshop/create", function () use ($app) {
    $app->renderPage("admin/webshop/create", "webshop create");
});

$app->router->add("webshop/something/{id}/{thing}", function ($id, $thing) use ($app) {
    $app->connect->execute("CALL Feed($id, $thing)");
    $app->redirect("webshop");
});

// $app->connect->getAllRes("CALL Feed($id, $thing)")
// $app->connect->execute("INSERT INTO `Product` (`description`, `category`, `imgLink`, `price`) VALUES ("$description", "$category", "$imgLink", $price)");
