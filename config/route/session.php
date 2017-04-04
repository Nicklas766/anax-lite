<?php
/**
 * Session Routes.
 */
 $app->router->add("session/increment8", function () use ($app) {
     $app->view->add("session/dump", [
      "redirect" => $app->url->create("session")
     ]);
     $app->response->setBody([$app->view, "render"])
                  ->send();
 });

    $app->router->add("session/increment", function () use ($app) {
        $app->view->add("session/increment", [
         "redirect" => $app->url->create("session")
        ]);
        $app->response->setBody([$app->view, "render"])
                       ->send();
    });
     $app->router->add("session/decrement", function () use ($app) {
         $app->view->add("session/decrement", [
          "redirect" => $app->url->create("session")
         ]);
         $app->response->setBody([$app->view, "render"])
                       ->send();
     });
        $app->router->add("session/dump", function () use ($app) {
             $app->view->add("session/header", ["title" => "Home"]);
             $app->view->add("navbar2/navbar");
             $app->view->add("session/dump", [
              "redirect" => $app->url->create("session")
             ]);
              $app->view->add("take1/byline");
               $app->view->add("take1/footer");
             $app->response->setBody([$app->view, "render"])
                           ->send();
        });
         $app->router->add("session/destroy", function () use ($app) {
             $app->view->add("session/destroy", [
              "redirect" => $app->url->create("session/dump")
             ]);
             $app->response->setBody([$app->view, "render"])
                           ->send();
         });

             $app->router->add("session/status", function () use ($app) {
                 $app->session->start();
                 $data = [
                     "Session name" => session_name(),
                     "Session id" => session_id(),
                     "Session status" => session_status(),
                 ];
                 $app->response->sendJson($data);
             });
