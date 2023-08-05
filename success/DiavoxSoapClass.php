<?php

use GuzzleHttp\Client;

class DiavoxSoapClass
{
    protected $client;

    public $requestResponse;

    public function __construct()
    {
        require 'vendor/autoload.php';
        $this->client = new Client();
    }

    public function soapRequest($requestXml, $url, $headers)
    {
        $this->requestResponse = $this->client->post($url, [
            'headers' => $headers,
            'body' => $requestXml,
        ]);
    }

    public function getBody()
    {
        return (string) $this->requestResponse->getBody();
    }




    public function toJson($xmlnamespace)
    {
        $simpleXml = simplexml_load_string($this->getBody());
        $namespaces = $simpleXml->getNamespaces(true);
        if (!empty($namespaces)) {
            $data = $simpleXml->children($namespaces[$xmlnamespace]);
        }
        return json_encode($data->Body->children(), JSON_PRETTY_PRINT);
    }



    public function toXml()
    {
        return htmlspecialchars($this->getBody());
    }
}
