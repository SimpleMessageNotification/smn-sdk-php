<?php 
require(__DIR__ . '/../smn-sdk-php/Bootstrap.php');
use SMN\Auth\CloudAccount as CloudAccount;
use SMN\Core\RestClient as RestClient;
use SMN\Request;

//userName:'useX',password:'abc123',domainName:'useX',regionId:'cn-south-1'
$account = new CloudAccount('useX','abc123','useX','cn-south-1');
$smsRequest = new Request\SmsPublishRequest($account);
$smsRequest->setEndpoint("+86153****50");
$smsRequest->setMessage("Hello SMN.");
$smsRequest->setSignId("6be340e91e5241e4b5d85837e6708130");
$request = $smsRequest->buildRequest();
$response = RestClient::getResponse($request);
print_r($response);


?>
