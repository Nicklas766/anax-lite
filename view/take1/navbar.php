<?php
//  set example
// $urlHome  = $app->url->create("");
// $urlAbout = $app->url->create("about");
// $urlReport = $app->url->create("report");

// Multidimensional Array that contain navbar class, and option information for href.
$navbar = [
    "config" => [
        "navbar-class" => "navbar"
    ],
    "items" => [
        "hem" => [
            "text" => "Hem",
            "route" => "",
        ],
        "about" => [
            "text" => "Om",
            "route" => "about",
        ],
        "report" => [
            "text" => "Redovisning",
            "route" => "report",
        ],
    ]
];
//
// print_r($navbar);
// print_r(array_keys($navbar));
// print_r($navbar["items"]);

// Get current route
$currentRoute = $app->request->getRoute();

// Get class from $navbar array
echo "<navbar class='" . $navbar["config"]["navbar-class"] . "'>";

// start foreach loop

//  Scan through outer loop
foreach ($navbar["items"] as $inner) {
    // use indexes to create url with route and set list href correctly
    $urlOption  = $app->url->create($inner["route"]);
    // If it matches with current route, add "current class".
    if ($inner["route"] == $currentRoute) {
        echo " <li><a href='$urlOption' class='current'>" . $inner["text"] . "</a></li>";
    } else {
        echo "<li><a href='$urlOption'>" . $inner["text"] . "</a></li>";
    }
}
echo "</navbar>";
?>


</div>

<div class="main">

<article>
