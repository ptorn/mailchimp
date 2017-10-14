<?php

namespace Peto16\Admin;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Peto16\Admin\HTMLForm\MailChimpConfigForm;

class AdminController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    private $userService;
    private $pageRender;
    private $redirect;
    private $view;
    private $mailChimpService;

    public function init()
    {
        $this->userService = $this->di->get("userService");
        // $this->response = $this->di->get("response");
        // $this->request = $this->di->get("request");
        $this->response = $this->di->get("response");
        $this->view = $this->di->get("view");
        $this->pageRender = $this->di->get("pageRender");
        $this->mailChimpService = $this->di->get("mailChimpService");

    }


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
                "defaultList"     => $this->mailChimpService->getDefaultList(),
                "form"            => $form->getHTML(),
            ], "main");
            $this->pageRender->renderPage(["title" => "MailChimp Configuration"]);
        }
        $this->response->redirect("user/login");
    }



    public function getListSubscribers()
    {
        $data = $this->mailChimpService->getSubscribersDefaultList();
        $this->view->add("admin/mailChimpTabs", [], "main");

        $this->view->add("mailchimp/listsubscribers", [
            "data"  => $data,
            "defaultListId"     => $this->mailChimpService->getDefaultList()
        ], "main");
        $this->pageRender->renderPage(["title" => "MailChimp Subscribers"]);
    }
}
