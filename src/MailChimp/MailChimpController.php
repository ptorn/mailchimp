<?php

namespace Peto16\MailChimp;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Peto16\MailChimp\HTMLForm\SubscribeForm;

/**
 * Controller for Login
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
        $this->mailChimpList = new MailChimpList();
        $this->response = $this->di->get("response");
        $this->request = $this->di->get("request");
        $this->view = $this->di->get("view");
        $this->pageRender = $this->di->get("pageRender");
    }


    public function getAccount()
    {
        $this->response->sendJson($this->mailChimp->sendRequest("GET", ["reports"]));
        exit;
    }


    public function getList()
    {
        $this->response->sendJson($this->mailChimp->sendRequest("GET", "/lists"));
        exit;
    }



    /**
     * Add recipient to list
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


    public function getListSubscribers()
    {
        $data = $this->mailChimp->getSubscribers();
        $this->response->sendJson($data);
        exit;
    }
}