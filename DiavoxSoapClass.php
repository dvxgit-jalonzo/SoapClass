<?php

use GuzzleHttp\Client;

class DiavoxSoapClass
{
    protected $client;

    public function __construct()
    {
        require 'vendor/autoload.php';
        $this->client = new Client();
    }

    public function soapRequest($requestXml, $url, $headers, $xmlnamespace)
    {
        $response = $this->client->post($url, [
            'headers' => $headers,
            'body' => $requestXml,
        ]);

        $responseXml = (string) $response->getBody();

        return $this->soapParser($responseXml, $xmlnamespace);
    }

    public function soapParser($responseXml, $xmlnamespace)
    {
        $simpleXml = simplexml_load_string($responseXml);
        $namespaces = $simpleXml->getNamespaces(true);
        $soapenv = $simpleXml->children($namespaces[$xmlnamespace]);
        return json_encode($soapenv->Body->children(), JSON_PRETTY_PRINT);
    }
}
