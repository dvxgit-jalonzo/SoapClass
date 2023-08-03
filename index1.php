<?php
$requestXml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?><SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><SOAP-ENV:Body><m:EMInteractions xmlns:m="http://schemas.ericsson.se/enterprise/mecs/eemm"><m:EMInteraction><m:GenericRequest><m:TargetSystem>TSN</m:TargetSystem><m:TaskObject>Extension/DigitalExtension</m:TaskObject><m:Action>change</m:Action></m:GenericRequest><m:Tokens><m:UserID>Diavox</m:UserID><m:Password>Diavox</m:Password><m:ApplicationID>Diavox</m:ApplicationID><m:OnBehalfOf>Diavox</m:OnBehalfOf><m:SessionID>diavox</m:SessionID><m:TransactionID></m:TransactionID></m:Tokens><m:EMType><m:TSA><m:DigitalExtension_VOs><m:DigitalExtension_VO><m:DIR>209</m:DIR><m:KSDDP><m:CAT><m:CATNumber>61</m:CATNumber></m:CAT></m:KSDDP><m:NIINP><m:Name1>Jhun</m:Name1><m:Name2>Alonzo</m:Name2></m:NIINP></m:DigitalExtension_VO></m:DigitalExtension_VOs></m:TSA></m:EMType></m:EMInteraction></m:EMInteractions></SOAP-ENV:Body></SOAP-ENV:Envelope>';
$url = 'http://192.3.33.64/tsaem/services/DigitalExtension';
$headers = array(
    'Content-Type: text/xml; charset=utf-8',
    'SOAPAction: urn:#changeDigitalExtension',
    'Content-Length: ' . strlen($requestXml),
);

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
$simpleXml = simplexml_load_string($responseXml);

function soapParser($responseXml, $xmlnamespace)
{
    $simpleXml = simplexml_load_string($responseXml);
    $namespaces = $simpleXml->getNamespaces(true);
    $soapenv = $simpleXml->children($namespaces[$xmlnamespace]);
    return json_encode($soapenv->Body->children(), JSON_PRETTY_PRINT);
}
echo soapParser('<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
   <soapenv:Header />
   <soapenv:Body>
      <EMInteractions xmlns:axis2ns36="http://schemas.ericsson.se/enterprise/mecs/eemm">
         <EMInteraction>
            <GenericRequest>
               <TargetSystem>TSN</TargetSystem>
               <TaskObject>Extension/DigitalExtension</TaskObject>
               <Action>change</Action>
            </GenericRequest>
            <Tokens>
               <UserID>Diavox</UserID>
               <Password>Diavox</Password>
               <ApplicationID>Diavox</ApplicationID>
               <OnBehalfOf>Diavox</OnBehalfOf>
               <SessionID>07F331A62330D56E573CCD26A8BDFBE5</SessionID>
               <TransactionID />
            </Tokens>
            <EMType>
               <TSA>
                  <GenericResponse>
                     <Info>
                        <ID>209</ID>
                        <OK>true</OK>
                     </Info>
                  </GenericResponse>
               </TSA>
            </EMType>
         </EMInteraction>
      </EMInteractions>
   </soapenv:Body>
</soapenv:Envelope>', 'soapenv');
