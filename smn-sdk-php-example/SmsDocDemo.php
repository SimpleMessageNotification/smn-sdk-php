<?php

require_once(__DIR__ . '/../smn-sdk-php/Bootstrap.php');

use SMN\Client\DefaultSmnClient as DefaultSmnClient;

$client = new DefaultSmnClient(
    'YourAccountUserName',
    'YourAccountDomainName',
    'YourAccountPassword',
    'YourRegionName');

$smnRequest = new SMN\Request\Sms\SmsPublishRequest();
$smnRequest->setEndpoint('8613688807587')
    ->setSignId('6be340e91e5241e4b5d85837e6709104')
    ->setMessage('您的验证码是:12346，请查收');
$response = $client->sendRequest($smnRequest);
print_r($response->isSuccess());
print_r($response->body);

