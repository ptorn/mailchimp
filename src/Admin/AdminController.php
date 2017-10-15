<?php

namespace Peto16\Admin;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Peto16\MailChimp\HTMLForm\MailChimpConfigForm;

class AdminController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    private $userService;
    private $pageRender;
    private $redirect;
    private $view;
    private $mailChimpService;



    /**
     * Method to initiate all the dependencies.
     * @return void
     */
    public function init()
    {
        $this->userService = $this->di->get("userService");
        $this->response = $this->di->get("response");
        $this->view = $this->di->get("view");
        $this->pageRender = $this->di->get("pageRender");
        $this->mailChimpService = $this->di->get("mailChimpService");
    }



    /**
     * Create view and setup the dashboard.
     * @return void
     */
    public function getDashboard()
    {
        $user = $this->userService->getCurrentLoggedInUser();
        $users = [];
        if ($user) {
            if ($user->administrator) {
                $users = $this->userService->findAllUsers();
            }
            $this->view->add("admin/dashboard", [
                "user"          => $user,
                "users"         => $users,
                "gravatarUrl"   => $this->userService->generateGravatarUrl($user->email)
            ], "main");
            $this->pageRender->renderPage(["title" => "Admin Dashboard"]);
        }
        $this->response->redirect("user/login");
    }



    /**
     * Create view for MailChimp dashboard.
     * @return void
     */
    public function getMailChimp()
    {
        $user = $this->userService->getCurrentLoggedInUser();
        if ($user) {
            $title      = "MailChimp Configuration";
            $form       = new MailChimpConfigForm($this->di);

            $form->check();

            $this->view->add("admin/mailChimpTabs", [], "main");
            $this->view->add("admin/mailchimpConfig", [
                "apiKey"          => $this->mailChimpService->getApiKey(),
                "endpointUrl"     => $this->mailChimpService->getEndpointUrl(),
                "defaultList"     => $this->mailChimpService->getDefaultListData(),
                "form"            => $form->getHTML(),
            ], "main");
            $this->pageRender->renderPage(["title" => "MailChimp Configuration"]);
        }
        $this->response->redirect("user/login");
    }



    /**
     * Create view to list all subscribers of defaultList
     * @return void
     */
    public function getListSubscribers()
    {
        $data = $this->mailChimpService->getSubscribersDefaultList();
        $this->view->add("admin/mailChimpTabs", [], "main");

        $this->view->add("mailchimp/listsubscribers", [
            "data"  => $data,
            "defaultListData"   => $this->mailChimpService->getDefaultListData()
        ], "main");
        $this->pageRender->renderPage(["title" => "MailChimp Subscribers"]);
    }
}
