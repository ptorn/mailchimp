<?php

namespace Peto16\Admin;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

class AdminController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    private $userService;
    private $pageRender;
    private $redirect;
    private $view;

    public function init()
    {
        $this->userService = $this->di->get("userService");
        // $this->response = $this->di->get("response");
        // $this->request = $this->di->get("request");
        $this->response = $this->di->get("response");
        $this->view = $this->di->get("view");
        $this->pageRender = $this->di->get("pageRender");
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
        $this->response->redirect("login");
    }



    public function getMailChimp()
    {
        $user = $this->userService->getCurrentLoggedInUser();
        $mailChimpService = $this->di->get("mailChimpService");
        // $users = [];
        if ($user) {
            // if ($user->administrator) {
            //     $users = $this->userService->findAllUsers();
            // }
            $this->view->add("admin/mailchimp", [
                "apiKey"          => $mailChimpService->getApiKey(),
                "endpointUrl"     => $mailChimpService->getEndpointUrl(),
                "defaultList"     => $mailChimpService->getDefaultList()
            ], "main");
            $this->pageRender->renderPage(["title" => "MailChimp Configuration"]);
        }
        $this->response->redirect("login");
    }
}
