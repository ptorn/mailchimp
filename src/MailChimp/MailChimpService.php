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
     * @return void
     */
    public function __construct($di)
    {
        $this->mailChimp = new MailChimp();
        $this->mailChimp->setDb($di->get("db"));
        $this->mailChimp->init();
    }



    /**
     * Get the id of the default list.
     * @return string The default list id.
     */
    public function getDefaultListId()
    {
        return $this->mailChimp->defaultList;
    }



    /**
     * Get Data for default list.
     * @return object Default list data.
     */
    public function getDefaultListData()
    {
        return $this->mailChimp->getDefaultListData();
    }



    /**
     * Get subscribers of the default list.
     * @return object Subscribers of the default list.
     */
    public function getSubscribersDefaultList()
    {
        return $this->mailChimp->getSubscribersDefaultList();
    }



    /**
     * Get all lists of MailChimp account.
     * @return object All lists of MailChimp account.
     */
    public function getAllLists()
    {
        return $this->mailChimp->getAllLists();
    }



    /**
     * Add a subscriber to the default list.
     * @param string $email     Email address
     * @param string $firstname Firstname
     * @param string $lastname  Lastname
     * @return void
     */
    public function addSubscriber($email, $firstname = "", $lastname = "")
    {
        $this->mailChimp->addSubscriber($email, $firstname, $lastname);
    }



    /**
     * Get apiKey stored.
     * @return string ApiKey
     */
    public function getApiKey()
    {
        return $this->mailChimp->apiKey;
    }



    /**
     * Get endpoint url.
     * @return string Endpoint url.
     */
    public function getEndpointUrl()
    {
        return $this->mailChimp->getEndpointUrl();
    }



    /**
     * Get status of widget in sidebar.
     * @return boolean Widget status.
     */
    public function getWidgetStatus()
    {
        return $this->mailChimp->widget;
    }



    /**
     * Get status of popup on frontpage.
     * @return boolean Popup status.
     */
    public function getPopupStatus()
    {
        return $this->mailChimp->popup;
    }



    /**
     * Add config to starage.
     * @param string    $apiKey      ApiKey
     * @param boolean   $widget      Status of widget.
     * @param boolean   $popup       Status of popup.
     * @param string    $defaultList String of list id.
     */
    public function addConfig($apiKey, $widget, $popup, $defaultList)
    {
        $this->mailChimp->apiKey = $apiKey;
        $this->mailChimp->widget = $widget;
        $this->mailChimp->popup = $popup;
        $this->mailChimp->defaultList = $defaultList;
        return $this->mailChimp->save();
    }
}
