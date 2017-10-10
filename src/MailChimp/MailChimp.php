<?php

namespace Peto16\MailChimp;

use \Anax\Database\ActiveRecordModel;

class MailChimp extends ActiveRecordModel implements MailChimpInterface
{
    protected $tableName = "mailchimp_Config";

    public $defaultList;
    public $apiKey;



    public function init()
    {
        $this->find("id", "1");
    }



    public function getEndpointUrl()
    {
        // Datacenter based on apiKey
        $dc = substr($this->apiKey, strrpos($this->apiKey, "-") + 1);
        return "https://" . $dc . ".api.mailchimp.com/3.0/";
    }



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
                # code...
                break;
        }
        $head = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return json_decode($head);
    }



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



    public function getSubscribers()
    {
        $list = "ec0e68d734"; // temp hardcoded
        return $this->sendRequest("GET", "lists/" . $list . "/members/")->members;
    }



    public function getApiKey()
    {
        return $this->apiKey;
    }



    public function getAllLists()
    {

    }
}
