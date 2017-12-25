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
 * publish demo
 * 消息发布demo
 */
$client = new DefaultSmnClient(
    'YourAccountUserName',
    'YourAccountDomainName',
    'YourAccountPassword',
    'YourRegionName');

// the demo lists
// publish with message
publishWithMessage();
// publish with message structure
publishWithMessageStructure();
// publish with message template
publishWithMessageTemplate();

/**
 * 根据message发布消息
 * publis message
 * @throws \SMN\Exception\SMNException
 */
function publishWithMessage()
{
    global $client;
    $smnRequest = new SMN\Request\Publish\PublishWithMessageRequest();
    $smnRequest->setTopicUrn('urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:create_by_zhangyx_test_csharp')
        ->setMessage('测试消息by php sdk')
        ->setSubject('测试消息subject');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 根据message发布消息
 * publis message with message structure
 * @throws \SMN\Exception\SMNException
 */
function publishWithMessageStructure()
{
    global $client;
    $smnRequest = new SMN\Request\Publish\PublishWithStructureRequest();
    $smnRequest->setTopicUrn('urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:create_by_zhangyx_test_csharp')
        ->setSubject('测试消息subject')
        ->setMessageStructure('{
		"default":"test by zhangyx structure php sdk",
		"email":"test by zhangyx structure email  php sdk",
		"sms":"test by zhangyx structure _sms  php sdk"}');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 根据message template发布消息
 * publis message with message template
 * @throws \SMN\Exception\SMNException
 */
function publishWithMessageTemplate()
{
    global $client;
    $smnRequest = new SMN\Request\Publish\PublishWithTemplateRequest();
    $smnRequest->setTopicUrn('urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:create_by_zhangyx_test_csharp')
        ->setSubject('测试消息subject')
        ->setMessageTemplateName('createMessageTemplate')
        ->setTags('{
        "year": "topic_urn3331",
        "company": "topic_id3332"
        }');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}