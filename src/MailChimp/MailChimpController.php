<?php

namespace Peto16\MailChimp;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Peto16\MailChimp\HTMLForm\SubscribeForm;

/**
 * Controller for MailChimpController
 */
class MailChimpController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    private $mailChimp;
    private $response;
    private $request;
    private $view;
    private $pageRender;



    /**
     * Initiate the controller.
     * @return void
     */
    public function init()
    {
        $this->mailChimp = new MailChimp();
        $this->mailChimp->setDb($this->di->get("db"));
        $this->mailChimp->init();
        $this->response = $this->di->get("response");
        $this->request = $this->di->get("request");
        $this->view = $this->di->get("view");
        $this->pageRender = $this->di->get("pageRender");
    }



    /**
     * Add recipient to list
     * @return void
     */
    public function getPostSubscriber()
    {
        $title      = "Add email to mailinglist";
        $form       = new SubscribeForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(),
        ];
        $this->view->add("mailchimp/subscribe", $data);

        $this->pageRender->renderPage(["title" => $title]);
    }



    /**
     * Get list of subscribers as JSON.
     * @return void
     */
    public function getListSubscribersJSON()
    {
        $data = $this->mailChimp->getSubscribersDefaultList();
        $this->response->sendJson($data);
        exit;
    }



    /**
     * If activated create view with block for sidebar.
     * @return void
     */
    public function getPostBlockSidebar()
    {
        if ($this->mailChimp->widget === 1) {
            $title      = "Add email to mailinglist";
            $form       = new SubscribeForm($this->di);

            $form->check();

            $data = [
                "form" => $form->getHTML(),
            ];
            $this->view->add("mailchimp/subscribe", $data, "sidebar-right");
        }
    }



    /**
     * If activated create view for popup subscription form.
     * @return [type] [description]
     */
    public function getPostPopup()
    {
        $popupCookie = isset($_COOKIE['popup']) ? $_COOKIE['popup'] : false;
        if ($this->mailChimp->popup === 1 && $popupCookie != true) {
            $title      = "Add email to mailinglist";
            $form       = new SubscribeForm($this->di);

            $form->check();

            $data = [
                "form" => $form->getHTML(),
            ];
            $this->view->add("mailchimp/popup", $data, "popup");
            setcookie("popup", true);
        }
    }
}
