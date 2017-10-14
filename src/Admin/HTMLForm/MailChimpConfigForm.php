<?php

namespace Peto16\Admin\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Peto16\MailChimp\MailChimpService;

/**
 * Example of FormModel implementation.
 */
class MailChimpConfigForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        parent::__construct($di);
        $mailChimpService = $di->get("mailChimpService");
        $allListsData = $mailChimpService->getAllLists();
        $allLists = [];
        if ($allListsData !== null) {
            foreach ($allListsData as $list) {
                $allLists = array_merge($allLists, $list);
            }
        }

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => ""
            ],
            [
                "ApiKey" => [
                    "type"        => "text",
                    "value"       => htmlspecialchars($mailChimpService->getApiKey()),
                    // "description" => "Here you can place a description.",
                    // "placeholder" => "Here is a placeholder",
                ],

                "DefaultList" => [
                    "type"        => "select",
                    "label"       => "Select your default mailinglist:",
                    "options"     => $allLists,
                    "value"       => $mailChimpService->getDefaultList(),
                ],

                "Widget" => [
                    "type"        => "checkbox",
                    "checked"       => $mailChimpService->getWidgetStatus() === 1 ? 1 : 0,
                    "description" => "Widget for sidebar.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Update",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        // Remember values during resubmit, useful when failing (retunr false)
        // and asking the user to resubmit the form.
        $this->form->rememberValues();
        $apiKey = $this->form->value("ApiKey");
        $widget = $this->form->value("Widget");
        $defaultList = $this->form->value("DefaultList");
        $apiKey = $apiKey === "" ? "null" : $apiKey;

        $mailChimpService = new MailChimpService($this->di);

        try {
            $mailChimpService->addConfig($apiKey, $widget, $defaultList);
        } catch (\Peto16\Admin\Exception $e) {
            $this->form->addOutput($e->getMessage());
            return false;
        }
        // return true;
        $this->form->addOutput("Configuration updated.");
        return true;
    }
}
