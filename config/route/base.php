<?php
/**
 * Routes.
 */
$app->router->add("", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Home"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("take1/home");
    $app->view->add("take1/byline");
    $app->view->add("admin/content/blocks", [
        "pageLink" => $app->url->create("page")
    ]);
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("about", function () use ($app) {
    $app->renderPage("take1/about,take1/byline", "about");
});
$app->router->add("report", function () use ($app) {
    $app->renderPage("take1/report,take1/byline", "Report");
});
// -------------------------------------------------------
// KOM02 SESSION, CALENDAR
// -------------------------------------------------------
$app->router->add("session", function () use ($app) {
    $app->renderPage("session", "Session");
});

$app->router->add("calendar", function () use ($app) {
    $app->view->add("take1/header", ["title" => "Calendar"]);
    $app->view->add("navbar2/navbar");
    $app->view->add("calendar", [
     "redirect" => $app->url->create("calendar")
    ]);
    $app->view->add("take1/footer");
    $app->response->setBody([$app->view, "render"])
                  ->send();
});



$app->router->add("status", function () use ($app) {
    $data = [
        "Server" => php_uname(),
        "PHP version" => phpversion(),
        "Included files" => count(get_included_files()),
        "Memory used" => memory_get_peak_usage(true),
        "Execution time" => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],
    ];
    $app->response->sendJson($data);
});
$app->router->add("search/{string}", function ($string) use ($app) {
    $data = [
        "Searchstring was" => $string
    ];
    $app->response->sendJson($data);
});
/**
 * Check arguments that matches a specific type.
 */
$callback = function ($value) use ($app) {
    $data = [
        "route"     => $app->request->getRoute(),
        "matched"   => $app->router->getLastRoute(),
        "value"     => $value,
    ];
    $app->response->sendJson($data);
};
$app->router->add("validate/{value:digit}", $callback);
$app->router->add("validate/{value:hex}", $callback);
$app->router->add("validate/{value:alpha}", $callback);
$app->router->add("validate/{value:alphanum}", $callback);
