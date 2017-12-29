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
 * 自定义配置demo
 */
$client = new DefaultSmnClient(
    'YourAccountUserName',
    'YourAccountDomainName',
    'YourAccountPassword',
    'YourRegionName');

// 设置代理/set proxy
$config = new \SMN\Common\ClientConfiguration();
$config->setProxyHost('127.0.0.1');
$config->setProxyPort(8080);
$config->setTimeout(80);
$client->setClientConfiguration($config);

// 发送短信
smsPublish();
/**
 * 发送短信
 * send sms
 * @throws \SMN\Exception\SMNException
 */
function smsPublish()
{
    global $client;
    $smnRequest = new SMN\Request\Sms\SmsPublishRequest();
    $smnRequest->setEndpoint('86136****587')
        ->setSignId('6be340e91e5241e4b5d85837e6709104')
        ->setMessage('您的验证码是:12346，请查收');
    $response = $client->sendRequest($smnRequest);
    print_r($response->isSuccess());
    print_r($response->body);
}
