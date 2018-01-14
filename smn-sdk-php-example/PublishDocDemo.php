<?php

require_once(__DIR__ . '/../smn-sdk-php/Bootstrap.php');

use SMN\Client\DefaultSmnClient as DefaultSmnClient;

$client = new DefaultSmnClient(
    'YourAccountUserName',
    'YourAccountDomainName',
    'YourAccountPassword',
    'YourRegionName');

$smnRequest = new SMN\Request\Publish\PublishWithMessageRequest();
$smnRequest->setTopicUrn('urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:create_by_php_01')
    ->setMessage('测试消息by php sdk')
    ->setSubject('测试消息subject');
$response = $client->sendRequest($smnRequest);
print_r($response->isSuccess());
print_r($response->body);

