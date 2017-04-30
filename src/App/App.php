<?php

namespace nicklas\App;

/**
 * An App class to wrap the resources of the framework.
 */
class App
{

    public function redirect($url)
    {
        $this->response->redirect($this->url->create($url));
    }
    public function renderPage($pages, $title)
    {
        // Make an array of the comma separated string $page
        if (!is_array($pages)) {
            $pages = strtolower($pages);
            $pages = preg_replace('/\s/', '', explode(',', $pages));
        }
        // array sen foreach för att få ut dem
        $this->view->add("take1/header", ["title" => "$title"]);
        $this->view->add("navbar2/navbar");

        foreach ($pages as $value) {
            $this->view->add("$value");
        }
        $this->view->add("take1/footer");
        $this->response->setBody([$this->view, "render"])
                      ->send();
    }
}
