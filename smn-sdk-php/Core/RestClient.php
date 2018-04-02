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
 * @member ClientConfiguration $clientConfiguration httpclient config
 *
 * @author sunzhixi
 * @author zhangyx
 * @version 1.1.0
 */
class RestClient
{
    public static function getResponse($request, $clientConfiguration)
    {
        $method = $request->getMethod();
        $httpHelper = HttpHelper::init()
            ->uri($request->getUrl())
            ->method($method)
            ->addHeaders($request->getHeaders())
            ->expects($request->getExpectType());


        if ($method == Http::POST || $method == Http::PUT) {
            $httpHelper->body($request->getBodyParams(), $request->getContentType());
        }
        if (!is_null($clientConfiguration)) {
            self::setClienConfiguration($httpHelper, $clientConfiguration);
        }
        try {
            $response = $httpHelper->send();
        } catch (\Exception $exception) {
            throw new SMNException("SDK.ServerException", $exception->getMessage());
        }
        return $response;
    }

    private static function setClienConfiguration($httpHelper, $clientConfiguration)
    {
        if (!is_null($clientConfiguration->getProxyHost()) && !is_null($clientConfiguration->getProxyPort())) {
            $httpHelper->useProxy($clientConfiguration->getProxyHost(), $clientConfiguration->getProxyPort(),
                $clientConfiguration->getProxyAuthType(),
                $clientConfiguration->getAuthUsername(), $clientConfiguration->getAuthPassword(),
                $clientConfiguration->getProxyType());
        }

        if (!is_null($clientConfiguration->getTimeout())) {
            $httpHelper->timeout($clientConfiguration->getTimeout());
        }

        if (!is_null($clientConfiguration->getCert()) && !is_null($clientConfiguration->getKey())) {
            $httpHelper->clientSideCert($clientConfiguration->getCert(), $clientConfiguration->getKey(),
                $clientConfiguration->getPassphrase(), $clientConfiguration->getEncoding());
        }

        $httpHelper->strictSSL($clientConfiguration->isStrictSsl());
    }

    /**
     * check http response is scuccess
     * @param $status http code
     * @return bool
     */
    public static function isSuccess($status)
    {
        return $status >= 200 && $status < 300;
    }

    /**
     * check response is no permission
     * @param $response
     * @return bool
     */
    public static function isNoPermission($response)
    {
        if (!is_null($response)) {
            return $response->code == 403 || $response->code == 401;
        }
        return false;
    }
}
