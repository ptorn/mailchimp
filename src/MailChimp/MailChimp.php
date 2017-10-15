<?php

namespace Peto16\MailChimp;

use \Anax\Database\ActiveRecordModel;

/**
 * MailChimp ActiveRecordModel.
 */
class MailChimp extends ActiveRecordModel implements MailChimpInterface
{
    protected $tableName = "mailchimp_Config";

    public $defaultList;
    public $apiKey;
    public $widget;
    public $popup;



    /**
     * Method to populate the model.
     * @return void
     */
    public function init()
    {
        $this->findById(1);
    }



    /**
     * Generate endpoint url based upon the apiKey.
     * @return string       The url for the endpoint
     */
    public function getEndpointUrl()
    {
        // Datacenter based on apiKey
        $dc = substr($this->apiKey, strrpos($this->apiKey, "-") + 1);
        return "https://" . $dc . ".api.mailchimp.com/3.0/";
    }



    /**
     * Send the request to MailChimp.
     * @param  string $method Like GET|POST
     * @param  string $path   Path to append to the url for the endpoint.
     * @param  object $data   JSON object with the payload.
     * @return object         Returning a decoded JSON object.
     */
    public function sendRequest($method, $path, $data = null)
    {
        $url = $this->getEndpointUrl();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: apikey ' . $this->apiKey
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        switch ($method) {
            case 'GET':
                curl_setopt($ch, CURLOPT_URL, $url . $path);
                break;

            case 'POST':
                curl_setopt($ch, CURLOPT_URL, $url . $path);
                // Add the payload.
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                break;
        }
        $head = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return json_decode($head);
    }



    /**
     * Add subscriber to the defaultList
     * @param string $email     Email address
     * @param string $firstname Firstname
     * @param string $lastname  Lastname
     * @return boolean          Return true if successfull or thorw an exception.
     */
    public function addSubscriber($email, $firstname = "", $lastname = "")
    {
        $data = [
            "email_address" => $email,
            "status" => "subscribed",
            "merge_fields" => [
                "FNAME" => $firstname,
                "LNAME" => $lastname
            ]
        ];
        $jsonData = json_encode($data);
        $result = $this->sendRequest("POST", "lists/" . $this->defaultList . "/members/", $jsonData);
        if ($result->status !== "subscribed") {
            throw new Exception($result->title . ": " . $result->detail);
        }
        return true;
    }



    /**
     * Get the subscribers from the default list.
     * @return object With members of default list.
     */
    public function getSubscribersDefaultList()
    {
        return $this->sendRequest("GET", "lists/" . $this->defaultList . "/members/")->members;
    }



    /**
     * Get apiKey from storage.
     * @return string MailChimp ApiKey.
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }



    /**
     * Get all lists to the MaiChimp account.
     * @return object Return an object with all lists or return null.
     */
    public function getAllLists()
    {
        $listsDump = $this->sendRequest("GET", "lists/");
        if ($listsDump !== null) {
            $lists = $this->sendRequest("GET", "lists/")->lists;
            return array_map(function ($list) {
                return [
                    $list->id => $list->name,
                ];
            }, $lists);
        }
        return null;
    }



    /**
     * Get data of the default list.
     * @return object Returns the object of the default list.
     */
    public function getDefaultListData()
    {
        return $this->sendRequest("GET", "lists/" . $this->defaultList);
    }
}
