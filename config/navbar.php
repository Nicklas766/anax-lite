<?php

// Multidimensional Array that contain navbar class, and option information for href.
return [
    [
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
        "session" => [
            "text" => "Session",
            "route" => "session",
        ],
        "calendar" => [
            "text" => "Calendar",
            "route" => "calendar",
        ],
    ]
    ],
[
    "config" => [
        "navbar-class" => "session-navbar"
    ],
    "items" => [
        "increase" => [
            "text" => "/increase",
            "route" => "session/increment",
        ],
        "decrease" => [
            "text" => "/decrease",
            "route" => "session/decrement",
        ],
        "status" => [
            "text" => "/status",
            "route" => "session/status",
        ],
        "dump" => [
            "text" => "/dump",
            "route" => "session/dump",
        ],
        "destroy" => [
            "text" => "/destroy",
            "route" => "session/destroy",
        ],
    ]
]
];
