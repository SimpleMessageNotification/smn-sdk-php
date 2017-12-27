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

namespace SMN\Core;

use Http\Http;
use Http\HttpHelper as HttpHelper;
use SMN\Common\Config as Config;
use SMN\Exception\SMNException as SMNException;

/**
 * Clean, simple static class for HTTP REST Client.
 * in PHP.
 *
 * There is an emphasis of readability without loosing concise
 * syntax.  As such, you will notice that the library lends
 * itself very nicely to "chaining".  You will see several "alias"
 * methods: more readable method definitions that wrap
 * their more concise counterparts.  You will also notice
 * no public constructor.  This two adds to the readability
 * and "chainabilty" of the library.
 *
 * HTTP REST Client定义
 * @member string  $proxy_auth_type   代理类型
 * @member string  $auth_username     用户名
 * @member string  $auth_password     密码
 *
 * @author sunzhixi
 */
class RestClient
{
    public static function getResponse($request)
    {
        $method = $request->getMethod();
        $httpHelper = HttpHelper::init()
            ->uri($request->getUrl())
            ->method($method)
            ->addHeaders($request->getHeaders())
            ->expects($request->getExpectType())
            ->strictSSL(Config::$strictSsl);

        if ($method == Http::POST || $method == Http::PUT) {
            $httpHelper->body($request->getBodyParams(), $request->getContentType());
        }

        if (!is_null(Config::$proxy_host) && !is_null(Config::$proxy_port)) {
            $httpHelper = $httpHelper->useProxy(Config::$proxy_host, Config::$proxy_port, Config::$proxy_auth_type,
                Config::$auth_username, Config::$auth_password, Config::$proxy_type);
        }

        if (!is_null(Config::$timeout)) {
            $httpHelper = $httpHelper->timeout(Config::$timeout);
        }

        if (!is_null(Config::$cert) && !is_null(Config::$key)) {
            $httpHelper = $httpHelper->clientSideCert(Config::$cert, Config::$key,
                Config::$passphrase, Config::$encoding);
        }

        try {
            $response = $httpHelper->send();
        } catch (\Exception $exception) {
            throw new SMNException("SDK.ServerException", $exception->getMessage());
        }
        return $response;
    }

    public static function isSuccess($status)
    {
        return $status >= 200 && $status < 300;
    }
}
