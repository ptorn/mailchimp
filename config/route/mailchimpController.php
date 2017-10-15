<?php
return [
    "mount" => "mailchimp",
    "routes" => [
        [
            "info" => "Add email",
            "requestMethod" => "get|post",
            "path" => "subscribe",
            "callable" => ["mailChimpController", "getPostSubscriber"],
        ],
        [
            "info" => "List subscribers",
            "requestMethod" => "get",
            "path" => "listsubscribers",
            "callable" => ["mailChimpController", "getListSubscribersJSON"],
        ],
    ],
];
