<?php

namespace nicklas\Navbar;

/**
 * Navbar to generate HTML för a navbar from a configuration array.
 */

class Navbar implements \Anax\Common\AppInjectableInterface, \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait,
        \Anax\Common\AppInjectableTrait;

   /**
     * Set the app object to inject into view rendering phase.
     *
     * @param object $app with framework resources.
     *
     * @return $this
    */
    public function setApp($app)
    {
        $this->app = $app;
    }
    /**
     * Get HTML for the navbar.
     *
     * uses $app to get current routes
     * uses config/navbar.php as $this->config
     *
     * @return string as HTML with the navbar.
     */
    public function getHTML($index = 0)
    {

        $htmlCode = "";
        // Get current route
        $currentRoute = $this->app->request->getRoute();

        // Get class from $this->config array
        $htmlCode .= "<navbar class='" . $this->config[$index]["config"]["navbar-class"] . "'>";

        // start foreach loop

        //  Scan through outer loop
        foreach ($this->config[$index]["items"] as $inner) {
            // use indexes to create url with route and set list href correctly
            $urlOption  = $this->app->url->create($inner["route"]);
            // If it matches with current route, add "current class".
            if ($inner["route"] == $currentRoute) {
                $htmlCode .= " <li><a href='$urlOption' class='current'>" . $inner["text"] . "</a></li>";
            } else {
                $htmlCode .= "<li><a href='$urlOption'>" . $inner["text"] . "</a></li>";
            }
        }
        $htmlCode .= "</navbar>";

        return $htmlCode;
    }
}
