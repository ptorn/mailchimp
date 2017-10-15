<?php
return [
    "mount" => "",
    "routes" => [
        [
            "info" => "Frontpage",
            "requestMethod" => "get|post",
            "path" => "/",
            "callable" => ["mailChimpController", "getPostPopup"],
        ],
    ]
];
