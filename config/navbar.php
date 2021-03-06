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
        "textfilter" => [
            "text" => "Textfilter",
            "route" => "textfilter",
        ],
        "Pages" => [
            "text" => "Pages",
            "route" => "pages",
        ],
        "Blog" => [
            "text" => "Blog",
            "route" => "blog",
        ],
        "Webshop" => [
            "text" => "Webshop",
            "route" => "webshop",
        ],
        "login" => [
            "text" => "Login",
            "route" => "login",
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
    ],
      [
      "config" => [
        "navbar-class" => "admin-navbar"
      ],
      "items" => [
        "users" => [
            "text" => "Users",
            "route" => "admin/users",
        ],
        "search" => [
            "text" => "Search",
            "route" => "admin/search",
        ],
        "add" => [
            "text" => "Add",
            "route" => "admin/add",
        ],

        "create" => [
            "text" => "Create",
            "route" => "admin/create",
        ],
        "overview" => [
            "text" => "Overview",
            "route" => "admin/overview",
        ],

      ]
        ],
      [
      "config" => [
        "navbar-class" => "session-navbar"
      ],
      "items" => [
        "webshop" => [
            "text" => "webshop",
            "route" => "webshop",
        ],
        "stock" => [
            "text" => "stock",
            "route" => "webshop/stock",
        ],
      ]
      ]
];
