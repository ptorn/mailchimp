<?php
/**
 * Configuration file for DI container.
 */
return [
    // Services to add to the container.
    "services" => [
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
