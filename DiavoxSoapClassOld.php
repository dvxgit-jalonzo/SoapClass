<?php

class DiavoxSoapClassOld
{

    public function oldSendRequest($url, $requestXml, $headers)
    {

        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $requestXml,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true
        );

        $ch = curl_init();
        curl_setopt_array($ch, $curlOptions);
        $responseXml = curl_exec($ch);
        curl_close($ch);
        return simplexml_load_string($responseXml);
    }

    public function oldSoapParser($responseXml, $xmlnamespace)
    {
        $simpleXml = simplexml_load_string($responseXml);
        $namespaces = $simpleXml->getNamespaces(true);
        $soapenv = $simpleXml->children($namespaces[$xmlnamespace]);
        return json_encode($soapenv->Body->children(), JSON_PRETTY_PRINT);
    }
}
