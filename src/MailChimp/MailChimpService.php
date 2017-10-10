<?php

namespace Peto16\MailChimp;

/**
 * Service class for MailChimp.
 */
class MailChimpService
{

    private $mailChimp;
    private $mailChimpList;



    /**
     * Constructor for MailChimpService
     *
     * @param object            $di dependency injection.
     */
    public function __construct($di)
    {
        $this->mailChimp = new MailChimp();
        $this->mailChimp->setDb($di->get("db"));

        $this->mailChimpList = new MailChimpList();
        $this->mailChimpList->setDb($di->get("db"));
        $this->mailChimp->defaultlList = $this->getDefaultList();
    }



    public function getDefaultList()
    {
        return $this->mailChimpList->getDefaultList();
    }



    public function getAllLists()
    {
        return $this->mailChimp->getAllLists();
    }



    public function addSubscriber($email, $firstname = "", $lastname = "")
    {
        $this->mailChimp->addSubscriber($email, $firstname, $lastname);
    }
}
