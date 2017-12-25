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

namespace SMN\Response;

use SMN\Core\RestClient;

/**
 * Clean, simple class for HTTP Response.
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
 * HTTP响应类定义
 * @member stdclass $request   请求实例
 * @member int $code           响应状态吗
 * @member array or string $body        响应body体,如果$reques->expected_type="json",则body为数组
 * @member string $content_type         响应body类型，可取值为：application/json、text/html等
 * @member array $headers 响应头
 *
 * @author sunzhixi
 */
class Response
{
    public $request;
    public $code;
    public $body;
    public $content_type;
    public $headers;

    /**
     * Response constructor.
     * @param $request
     * @param $response
     */
    public function __construct($request, $response)
    {
        $this->request = $request;
        if (!is_null($response)) {
            $this->code = $response->code;
            $this->body = $response->body;
            $this->content_type = $response->content_type;
            $this->headers = $response->headers->toArray();
        }

    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    public function getContent_type()
    {
        return $this->content_type;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Status Code Definitions
     *
     * Informational 1xx
     * Successful    2xx
     * Redirection   3xx
     * Client Error  4xx
     * Server Error  5xx
     *
     * http://pretty-rfc.herokuapp.com/RFC2616#status.codes
     *
     * @return bool Did we receive a 4xx or 5xx?
     */
    public function hasErrors()
    {
        return $this->code >= 400;
    }

    /**
     * @return bool
     */
    public function hasBody()
    {
        return !empty($this->body);
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return RestClient::isSuccess($this->getCode());
    }
}

