<?php

require_once(__DIR__ . '/../smn-sdk-php/Bootstrap.php');

use SMN\Client\DefaultSmnClient as DefaultSmnClient;

$client = new DefaultSmnClient(
    'YourAccountUserName',
    'YourAccountDomainName',
    'YourAccountPassword',
    'YourRegionName');

$topicRequest = new SMN\Request\Topic\CreateTopicRequest();
$topicRequest->setName('create_by_php_01')
    ->setDisplayName('topic display name');
$topicResponse = $client->sendRequest($topicRequest);
print_r($topicResponse->isSuccess());
print_r($topicResponse->body);

$smnRequest = new SMN\Request\Subscription\SubscribeRequest();
$smnRequest->setEndpoint('+8613688807587')
    ->setProtocol('sms')
    ->setTopicUrn($topicResponse->body->topic_urn);
$response = $client->sendRequest($smnRequest);
print_r($response->isSuccess());
print_r($response->body);
