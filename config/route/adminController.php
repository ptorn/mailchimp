<?php
return [
    "mount" => "admin",
    "routes" => [
        [
            "info" => "Dashboard.",
            "requestMethod" => "get",
            "path" => "/",
            "callable" => ["adminController", "getDashboard"],
        ],
        [
            "info" => "Mailchimp",
            "requestMethod" => "get|post",
            "path" => "mailchimp",
            "callable" => ["adminController", "getMailChimp"],
        ],
        [
            "info" => "List subscribers",
            "requestMethod" => "get",
            "path" => "mailchimp/listsubscribers",
            "callable" => ["adminController", "getListSubscribers"],
        ],
        // [
        //     "info" => "Dashboard.",
        //     "requestMethod" => "get",
        //     "path" => "",
        //     "callable" => ["adminController", "dashboard"],
        // ]
    ]
];
