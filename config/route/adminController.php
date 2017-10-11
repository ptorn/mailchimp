<?php
return [
    "mount" => "admin",
    "routes" => [
        [
            "info" => "Dashboard.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["adminController", "getDashboard"],
        ],
        [
            "info" => "Mailchimp",
            "requestMethod" => "get",
            "path" => "mailchimp",
            "callable" => ["adminController", "getMailChimp"],
        ],
        // [
        //     "info" => "Dashboard.",
        //     "requestMethod" => "get",
        //     "path" => "",
        //     "callable" => ["adminController", "dashboard"],
        // ]
    ]
];
