<?php
/**
 * Configuration file for DI container.
 */
return [
    // Services to add to the container.
    "services" => [
        "mailChimpService" => [
            "shared" => true,
            "callback" => function () {
                $mailChimpService = new Peto16\MailChimp\MailChimpService($this);
                return $mailChimpService;
            }
        ],
        "mailChimpController" => [
            "shared" => true,
            "callback" => function () {
                $mailChimpController = new \Peto16\MailChimp\MailChimpController();
                $mailChimpController->setDI($this);
                $mailChimpController->init();
                return $mailChimpController;
            }
        ],
    ],
];
