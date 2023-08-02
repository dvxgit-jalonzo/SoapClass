<?php

include "DiavoxSoapClass.php";
// Usage example
$diavoxSoap = new DiavoxSoapClass();

$requestXml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
<soapenv:Header/>
<soapenv:Body>
   <eemm:EMInteractions xmlns:eemm="http://schemas.ericsson.se/enterprise/mecs/eemm">
      <eemm:EMInteraction>
         <eemm:GenericRequest>
            <eemm:TargetSystem>MP</eemm:TargetSystem>
            <eemm:TaskObject>java:global/mp/mp.jar/SubSystemBean!se.ericsson.ebc.emtsn.ejb.GenericManagerLocal</eemm:TaskObject>
            <eemm:Action>CHANGE</eemm:Action>
         </eemm:GenericRequest>
         <eemm:Tokens>
            <eemm:UserID>Diavox</eemm:UserID>
            <eemm:Password>Diavox!23</eemm:Password>
            <eemm:ApplicationID>diavox</eemm:ApplicationID>
            <eemm:OnBehalfOf>Diavox</eemm:OnBehalfOf>
            <eemm:TransactionID>1</eemm:TransactionID>
         </eemm:Tokens>
         <eemm:EMType>
            <eemm:MP>                  
               <eemm:SubSystem_VOs>
                   <eemm:SubSystem_VO>
                    <eemm:SubSystem>
                     <eemm:SubSystemName>LIM1</eemm:SubSystemName>
                    </eemm:SubSystem>
                    <eemm:ServiceSystem>
                    <eemm:Action>CHANGE</eemm:Action>
                     <eemm:TSA>
                         <eemm:IPExtension_VOs>
                             <eemm:IPExtension_VO>
                                 <eemm:DIR>1501</eemm:DIR>
                                 <eemm:GEDIP>
                                     <eemm:CSP>
                                         <eemm:CSPNumber>61</eemm:CSPNumber>
                                         <eemm:CSPName>61</eemm:CSPName>
                                     </eemm:CSP>
                                 </eemm:GEDIP>
                             </eemm:IPExtension_VO>
                         </eemm:IPExtension_VOs>
                      </eemm:TSA>
                    </eemm:ServiceSystem>
                   </eemm:SubSystem_VO>
               </eemm:SubSystem_VOs>
            </eemm:MP>
         </eemm:EMType>
      </eemm:EMInteraction>
   </eemm:EMInteractions>
</soapenv:Body>
</soapenv:Envelope>';

$url = 'http://192.168.0.110:80/mpwebservices/services/MP';

$headers = [
    'Content-Type' => 'text/xml; charset=utf-8',
    'SOAPAction' => 'urn:#manageData',
];

$xmlnamespace = 'SOAP-ENV';

$response = $diavoxSoap->soapRequest($requestXml, $url, $headers, $xmlnamespace);
echo $response;
