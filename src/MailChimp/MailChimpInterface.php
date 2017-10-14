<?php

namespace Peto16\MailChimp;

/**
 * Interface for MailChimp
 */
interface MailChimpInterface
{
    public function addSubscriber($email, $firstname = "", $lastname = "");
    public function getSubscribersDefaultList();
    public function getApiKey();
    public function getAllLists();
}
