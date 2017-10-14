<?php
return [
    "navbar" => [
        "config" => [
            "navbar-class" => "navbar"
        ],
        "items" => [
            "frontpage" => [
                "icon"  => "home",
                "title"  => "Start",
                "route" => "",
            ],
            "login" => [
                "icon"  => "lock",
                "title"  => "Login",
                "route" => "user/login",
            ],
            "logout" => [
                "icon"  => "lock",
                "title"  => "Admin",
                "route" => "admin",
                "submenu" => [
                    "items" => [
                        "dashboard" => [
                            "icon"      => "home",
                            "title"     => "Dashboard",
                            "route"     => "admin",
                        ],
                        "mailchimp" => [
                            "icon"      => "TBA",
                            "title"     => "MailChimp",
                            "route"     => "admin/mailchimp"
                        ],
                        "logout" => [
                            "icon"      => "TBA",
                            "title"     => "Logout",
                            "route"     => "user/logout"
                        ]

                    ]
                ]
            ]
        ]
    ],
    "social" => [
        "config" => [
            "navbar-class" => "social-links"
        ],
        "items" => [
            "github" => [
                "icon"  => "github",
                "title"  => "Github",
                "route" => "https://github.com/ptorn/mailchimp",
            ],
            "email" => [
                "icon"  => "envelope",
                "title"  => "E-post",
                "route" => "mailto:peder.tornberg@gmail.com",
            ]
        ]
    ]
];
