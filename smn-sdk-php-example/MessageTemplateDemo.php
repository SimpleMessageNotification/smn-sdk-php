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

 //the demo lists
// create message template
createMessageTemplate();
// update message template
updateMessageTemplate();
// delete message template
deleteMessageTemplate();
// list message templates
listMessageTemplates();
// query message tempalte detail
queryMessageTemplateDetail();

/**
 * 创建消息模板
 * Create message template
 * @throws \SMN\Exception\SMNException
 */
function createMessageTemplate()
{
    global $client;
    $smnRequest = new SMN\Request\Template\CreateMessageTemplateRequest();
    $smnRequest->setProtocol('sms')
        ->setMessageTemplateName('createByzhangyxPhpSdk')
        ->setContent('this is {year}');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 更新消息模板
 * update message template
 * @throws \SMN\Exception\SMNException
 */
function updateMessageTemplate()
{
    global $client;
    $smnRequest = new SMN\Request\Template\UpdateMessageTemplateRequest();
    $smnRequest->setMessageTemplateId('284aaf148152486592e580d951e47351')
        ->setContent('this is {year} _2');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 删除消息模板
 * delete message template
 * @throws \SMN\Exception\SMNException
 */
function deleteMessageTemplate()
{
    global $client;
    $smnRequest = new SMN\Request\Template\DeleteMessageTemplateRequest();
    $smnRequest->setMessageTemplateId('284aaf148152486592e580d951e47351');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 查询消息模板列表
 * list message templates
 * @throws \SMN\Exception\SMNException
 */
function listMessageTemplates()
{
    global $client;
    $smnRequest = new SMN\Request\Template\ListMessageTemplatesRequest();
    $smnRequest->setProtocol('sms')
        ->setOffset(0)
        ->setLimit(20)
        ->setMessageTemplateName('template_create_by_zhangyx_test_csharp');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 查询消息模板详情
 * query message template detail
 * @throws \SMN\Exception\SMNException
 */
function queryMessageTemplateDetail()
{
    global $client;
    $smnRequest = new SMN\Request\Template\QueryMessageTemplateDetailRequest();
    $smnRequest->setMessageTemplateId('cf1342072d034faeb7aaa92e276a3242');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}