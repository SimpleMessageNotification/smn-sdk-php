<?php
/**
 * Copyright (C) 2017. Huawei Technologies Co., LTD. All rights reserved.
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
use SMN\Auth\CloudAccount as CloudAccount;
use SMN\Core\RestClient as RestClient;
use SMN\Request;

//userName:'useX',password:'abc123',domainName:'useX',regionId:'cn-south-1'
$account = new CloudAccount('useX','abc123','useX','cn-south-1');
$smsRequest = new Request\SmsPublishRequest($account);
$smsRequest->setEndpoint("+86153******50");
$smsRequest->setMessage("Hello this is a smn-sdk-php test. The code has been uploaded to github.com. by : sunzhixi.");
$smsRequest->setSignId("6be340e91e5241e4b5d85837e6708310");
$request = $smsRequest->buildRequest();
//RestClient::setProxy_host("127.0.0.1");
//RestClient::setProxy_port(8080);
$response = RestClient::getResponse($request);
print_r($response);

?>
