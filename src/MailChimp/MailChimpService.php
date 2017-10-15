<?php

namespace Peto16\MailChimp;

/**
 * Service class for MailChimp.
 */
class MailChimpService
{

    private $mailChimp;



    /**
     * Constructor for MailChimpService
     *
     * @param object            $di dependency injection.
     */
    public function __construct($di)
    {
        $this->mailChimp = new MailChimp();
        $this->mailChimp->setDb($di->get("db"));
        $this->mailChimp->init();

    }

    public function getDefaultListId()
    {
        return $this->mailChimp->defaultList;
    }


    public function getDefaultListData()
    {
        return $this->mailChimp->getDefaultListData();
    }



    public function getSubscribersDefaultList()
    {
        return $this->mailChimp->getSubscribersDefaultList();
    }

    public function getAllLists()
    {
        return $this->mailChimp->getAllLists();
    }



    public function addSubscriber($email, $firstname = "", $lastname = "")
    {
        $this->mailChimp->addSubscriber($email, $firstname, $lastname);
    }



    public function getApiKey()
    {
        return $this->mailChimp->apiKey;
    }



    public function getEndpointUrl()
    {
        return $this->mailChimp->getEndpointUrl();
    }


    public function getWidgetStatus()
    {
        return $this->mailChimp->widget;
    }


    public function getPopupStatus()
    {
        return $this->mailChimp->popup;
    }


    public function addConfig($apiKey, $widget, $popup, $defaultList)
    {
        $this->mailChimp->apiKey = $apiKey;
        $this->mailChimp->widget = $widget;
        $this->mailChimp->popup = $popup;
        $this->mailChimp->defaultList = $defaultList;
        return $this->mailChimp->save();
    }
}
