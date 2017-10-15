<?php

namespace Peto16\MailChimp\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Peto16\MailChimp\MailChimpService;

/**
 * MailChimpConfigForm.
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
                "legend" => "",
            ],
            [
                "ApiKey" => [
                    "type"        => "text",
                    "value"       => htmlspecialchars($mailChimpService->getApiKey()),
                ],

                "DefaultList" => [
                    "type"        => "select",
                    "label"       => "Select your default mailinglist:",
                    "options"     => $allLists,
                    "value"       => $mailChimpService->getDefaultListId(),
                ],

                "Widget" => [
                    "type"        => "checkbox",
                    "checked"       => $mailChimpService->getWidgetStatus() === 1 ? 1 : 0,
                    "description" => "Widget for sidebar.",
                ],

                "Popup" => [
                    "type"        => "checkbox",
                    "checked"       => $mailChimpService->getPopupStatus() === 1 ? 1 : 0,
                    "description" => "Popup frontpage",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Update",
                    "callback" => [$this, "callbackSubmit"],
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
        $popup = $this->form->value("Popup");
        $mailChimpService = new MailChimpService($this->di);

        try {
            $mailChimpService->addConfig($apiKey, $widget, $popup, $defaultList);
        } catch (\Peto16\Admin\Exception $e) {
            $this->form->addOutput($e->getMessage());
            return false;
        }
        $this->form->addOutput("Configuration updated.");
        return true;
    }
}
