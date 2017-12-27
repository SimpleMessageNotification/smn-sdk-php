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
 * topic demo
 * topic相关操作demo
 */
$client = new DefaultSmnClient(
    'YourAccountUserName',
    'YourAccountDomainName',
    'YourAccountPassword',
    'YourRegionName');

// create topic
createTopic();
// list topics
listTopics();
// query topic detail
queryTopicDetail();
// update topic
updateTopic();
// delete topic
deleteTopic();
// list topic attributes
listTopicAttributes();
// update topic attribute
updateTopicAttribute();
// delete topic attribute by name
deleteTopicAttributeByName();
// delete all topic attributes
deleteTopicAttributes();


/**
 * 创建topic
 * create topic
 * @throws \SMN\Exception\SMNException
 */
function createTopic()
{
    global $client;
    $smnRequest = new SMN\Request\Topic\CreateTopicRequest();
    $smnRequest->setName('create_by_php_zhangyx_01')
        ->setDisplayName('the first topic');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 查询topic列表
 * list topics
 * @throws \SMN\Exception\SMNException
 */
function listTopics()
{
    global $client;
    $smnRequest = new SMN\Request\Topic\ListTopicsRequest();
    $smnRequest->setLimit(20)
        ->setOffset(1);
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}


/**
 * 查询topic详情
 * list topics
 * @throws \SMN\Exception\SMNException
 */
function queryTopicDetail()
{
    global $client;
    $smnRequest = new SMN\Request\Topic\QueryTopicDetailRequest();
    $smnRequest->setTopicUrn('urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:create_by_php_zhangyx_01');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 更新修改topic
 * update topic
 * @throws \SMN\Exception\SMNException
 */
function updateTopic()
{
    global $client;
    $smnRequest = new SMN\Request\Topic\UpdateTopicRequest();
    $smnRequest->setTopicUrn('urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:create_by_php_zhangyx_01')
        ->setDisplayName('更新修改');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 删除topic
 * delete topic
 * @throws \SMN\Exception\SMNException
 */
function deleteTopic()
{
    global $client;
    $smnRequest = new SMN\Request\Topic\DeleteTopicRequest();
    $smnRequest->setTopicUrn('urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:create_by_php_zhangyx_01');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 查询topic属性
 * list topic attributes
 * @throws \SMN\Exception\SMNException
 */
function listTopicAttributes()
{
    global $client;
    $smnRequest = new SMN\Request\Topic\ListTopicAttributesRequest();
    $smnRequest->setTopicUrn('urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:create_by_php_zhangyx_01');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 更新topic属性
 * update topic attribute
 * @throws \SMN\Exception\SMNException
 */
function updateTopicAttribute()
{
    global $client;
    $smnRequest = new SMN\Request\Topic\UpdateTopicAttributeRequest();
    $smnRequest->setTopicUrn('urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:create_by_php_zhangyx_01')
        ->setName('access_policy')
        ->setValue('{
         "Version": "2016-09-07",
         "Id": "__default_policy_ID",
         "Statement": [
            {
              "Sid": "__user_pub_0",
              "Effect": "Allow",
              "Principal": {
                "CSP": [
                         "urn:csp:iam::1040774eae344b78b14f2939863d4ede:root"
                       ]
                 },
              "Action": ["SMN:Publish","SMN:QueryTopicDetail"],
              "Resource": "urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:create_by_php_zhangyx_01"
              }
             ]
          }');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 根据名称删除topic属性
 * delete topic attribute by name
 * @throws \SMN\Exception\SMNException
 */
function deleteTopicAttributeByName()
{
    global $client;
    $smnRequest = new SMN\Request\Topic\DeleteTopicAttributeByNameRequest();
    $smnRequest->setTopicUrn('urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:create_by_php_zhangyx_01')
        ->setName('access_policy');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 删除所有topic属性
 * delete topic attributes
 * @throws \SMN\Exception\SMNException
 */
function deleteTopicAttributes()
{
    global $client;
    $smnRequest = new SMN\Request\Topic\DeleteTopicAttributesRequest();
    $smnRequest->setTopicUrn('urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:create_by_php_zhangyx_01');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}
