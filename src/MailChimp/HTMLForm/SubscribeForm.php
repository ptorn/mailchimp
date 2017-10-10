<?php

namespace Peto16\MailChimp\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Peto16\MailChimp\MailChimp;

/**
 * Example of FormModel implementation.
 */
class SubscribeForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        parent::__construct($di);

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Subscribe"
            ],
            [
                "Email" => [
                    "type"        => "email",
                    "required"    => true,
                    // "description" => "Here you can place a description.",
                    // "placeholder" => "Here is a placeholder",
                ],

                "Firstname" => [
                    "type"        => "text",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],
                "Lastname" => [
                    "type"        => "text",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Subscribe",
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
        $email = $this->form->value("Email");
        $fname = $this->form->value("Firstname") ? $this->form->value("Firstname") : "";
        $lname = $this->form->value("Lastname") ? $this->form->value("Lastname") : "";

        $mailChimp = new MailChimp();
        try {
            $mailChimp->addSubscriber($email, $fname, $lname);
        } catch (\Peto16\MailChimp\Exception $e) {
            $this->form->addOutput($e->getMessage());
            return false;
        }
        // return true;
        $this->form->addOutput("Subscriber added.");
        return true;
    }
}
