<?php
return [
    "mount" => "mailchimp",
    "routes" => [
        [
            "info" => "Get account info",
            "requestMethod" => "get",
            "path" => "account",
            "callable" => ["mailChimpController", "getAccount"],
        ],
        [
            "info" => "Get account info",
            "requestMethod" => "get",
            "path" => "list",
            "callable" => ["mailChimpController", "getList"],
        ],
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
            "callable" => ["mailChimpController", "getListSubscribers"],
        ],
    ],
];
