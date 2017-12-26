<?php
/**
 * Copyright (C) 2018. Huawei Technologies Co., LTD. All rights reserved.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of Apache License, Version 2.0.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * Apache License, Version 2.0 for more details.
 */

require_once(__DIR__ . '/../smn-sdk-php/Bootstrap.php');

use SMN\Client\DefaultSmnClient as DefaultSmnClient;

/**
 * subscription demo
 * 订阅类操作demo
 */
$client = new DefaultSmnClient(
    'YourAccountUserName',
    'YourAccountDomainName',
    'YourAccountPassword',
    'YourRegionName');

// the demo lists
//// 订阅 subscribe
//subscribe();
////取消 unsubscribe
//unsubscribe();
//// list subscriptions
//listSubscriptions();
// list subscriptions by topic
listSubscriptionsByTopic();
/**
 * 查询订阅列表
 * list subscriptions
 * @throws \SMN\Exception\SMNException
 */
function listSubscriptions()
{
    global $client;
    $smnRequest = new SMN\Request\Subscription\ListSubscriptionsRequest();
    $smnRequest->setLimit(20)
        ->setOffset(1);
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 根据topic查询订阅列表
 * list topics
 * @throws \SMN\Exception\SMNException
 */
function listSubscriptionsByTopic()
{
    global $client;
    $smnRequest = new SMN\Request\Subscription\ListSubscriptionsByTopicRequest();
    $smnRequest->setLimit(20)
        ->setOffset(0)
        ->setTopicUrn('urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:create_by_zhangyx_test_csharp');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 订阅
 * subscribe
 * @throws \SMN\Exception\SMNException
 */
function subscribe()
{
    global $client;
    $smnRequest = new SMN\Request\Subscription\SubscribeRequest();
    $smnRequest->setEndpoint('13688807587')
        ->setProtocol('sms')
        ->setTopicUrn('urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:testtyc');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 取消订阅
 * subscribe
 * @throws \SMN\Exception\SMNException
 */
function unsubscribe()
{
    global $client;
    $smnRequest = new SMN\Request\Subscription\UnsubscribeRequest();
    $smnRequest->setSubscriptionUrn('urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:testtyc:e2cea235811e4e75aa8ee0bd5cc0ccde');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}