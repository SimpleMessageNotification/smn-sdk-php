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
 * sms demo
 * 短信类操作demo
 */
$client = new DefaultSmnClient(
    'YourAccountUserName',
    'YourAccountDomainName',
    'YourAccountPassword',
    'YourRegionName');

// the demo lists
// sms publish
smsPublish();
// promotion sms publish
promotionSmsPublish();
// create sms template
createSmsTemplate();
// list sms signs
listSmsSigns();
// delete sms sign
deleteSmsSign();
// list sms msg report
listSmsMsgReport();
// update sms event
updateSmsEvent();
// get sms message
getSmsMessage();
// list sms event
listSmsEvent();
//delete sms template
deleteSmsTemplate();
// list sms templates
listSmsTemplates();
// get sms template detail
getSmsTemplateDetail();

/**
 * 发送通知验证码短信
 * send notify/verify sms
 * @throws \SMN\Exception\SMNException
 */
function smsPublish()
{
    global $client;
    $smnRequest = new SMN\Request\Sms\SmsPublishRequest();
    $smnRequest->setEndpoint('8613688807587')
        ->setSignId('6be340e91e5241e4b5d85837e6709104')
        ->setMessage('您的验证码是:12346，请查收');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 发送推广类短信
 *
 * send promotion sms
 * @throws \SMN\Exception\SMNException
 */
function promotionSmsPublish()
{
    global $client;
    $smnRequest = new \SMN\Request\Sms\PromotionSmsPublishRequest();
    $smnRequest->setEndpoints(array("13688807587", "13688807823"))
        ->setSignId("47f86cf7c9a7449d98ee61cf193a1060")
        ->setSmsTemplateId("bfda25c6406e42ddabad74b4a20f6d05");

    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 查询短信签名列表
 * list sms signs
 * @throws \SMN\Exception\SMNException
 */
function listSmsSigns()
{
    global $client;
    $smnRequest = new \SMN\Request\Sms\ListSmsSignsRequest();
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);

}

/**
 * 删除短信签名
 * delete sms sign
 * @throws \SMN\Exception\SMNException
 */
function deleteSmsSign()
{
    global $client;
    $smnRequest = new \SMN\Request\Sms\DeleteSmsSignRequest();
    $smnRequest->setSignId('a71b31e6820447a8a829f9ea12ac5baa');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);

}

/**
 * 查询短信的发送状态
 * list sms msg report
 * @throws \SMN\Exception\SMNException
 */
function listSmsMsgReport()
{
    global $client;
    $smnRequest = new \SMN\Request\Sms\ListSmsMsgReportRequest();
    $smnRequest->setStartTime('1512625955366')
        ->setEndTime('1512712355850')
        ->setLimit(2);
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);

}

/**
 * 更新短信回调事件
 * update sms event
 * @throws \SMN\Exception\SMNException
 */
function updateSmsEvent()
{
    global $client;
    $failEvent = array('event_type' => 'sms_fail_event', 'topic_urn' => 'urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:sms_event_urn');
    $replyEvent = array('event_type' => 'sms_reply_event', 'topic_urn' => 'urn:smn:cn-north-1:cffe4fc4c9a54219b60dbaf7b586e132:sms_event_urn');
    // 设置为空，表示删除该回调时间
    $successEvent = array('event_type' => 'sms_success_event', 'topic_urn' => '');

    $smnRequest = new \SMN\Request\Sms\UpdateSmsEventRequest();
    $smnRequest->setCallback(array($failEvent, $replyEvent, $successEvent));
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 查询短信回调事件
 * list sms event
 * @throws \SMN\Exception\SMNException
 */
function listSmsEvent()
{
    global $client;
    $smnRequest = new \SMN\Request\Sms\ListSmsEventRequest();
    // 该参数不设置查询所有
    $smnRequest->setEventType('sms_reply_event');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}


/**
 * 查询已发送短信的内容
 * get sms message
 * @throws \SMN\Exception\SMNException
 */
function getSmsMessage()
{
    global $client;
    $smnRequest = new \SMN\Request\Sms\GetSmsMessageRequest();
    $smnRequest->setMessageId('286a5588edc94506aea0bb6e1d32d418');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);

}

/**
 * 创建短信模板
 *
 * create sms template
 * @throws \SMN\Exception\SMNException
 */
function createSmsTemplate()
{
    global $client;
    $smnRequest = new \SMN\Request\Sms\CreateSmsTemplateRequest();
    $smnRequest->setRemark("helloworld")
        ->setSmsTemplateContent("拒绝套路，全线低价！快戳http://t.cn/RWafjJ，如有疑问详细4000-955-988转1，退订回TD")
        ->setSmsTemplateName("拒绝套路1234")
        ->setSmsTemplateType(1);

    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 查询短信模板列表
 *
 * list sms templates
 * @throws \SMN\Exception\SMNException
 */
function listSmsTemplates()
{
    global $client;
    $smnRequest = new \SMN\Request\Sms\ListSmsTemplatesRequest();
    $smnRequest->setLimit(10)
        ->setOffset(0)
        ->setSmsTemplateType(1)
        ->setSmsTemplateName("模板");

    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 查询短信模板详情
 *
 * get sms template detail
 * @throws \SMN\Exception\SMNException
 */
function getSmsTemplateDetail()
{
    global $client;
    $smnRequest = new \SMN\Request\Sms\GetSmsTemplateDetailRequest();
    $smnRequest->setSmsTemplateId("9ac30030ca2c42909638eb643bcd9d0c");

    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}

/**
 * 删除短信模板
 *
 * delete sms template
 * @throws \SMN\Exception\SMNException
 */
function deleteSmsTemplate()
{
    global $client;
    $smnRequest = new \SMN\Request\Sms\DeleteSmsTemplateRequest();
    $smnRequest->setSmsTemplateId("873b6edfafaa4dc1a77de0d24a9e9921");

    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}