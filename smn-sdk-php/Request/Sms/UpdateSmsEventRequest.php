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

namespace SMN\Request\Sms;

use Http\Http as Http;
use SMN\Common\Constants as Constants;
use SMN\Exception\SMNException as SMNException;
use SMN\Request\AbstractRequest as AbstractRequest;

/**
 * Class UpdateSmsEventRequest
 * the request to update sms event
 * @package SMN\Request\Sms
 * @author zhangyx
 * @version 1.1.0
 */
class UpdateSmsEventRequest extends AbstractRequest
{
    private $callback;

    public function getUrl()
    {
        if (empty($this->callback)) {
            throw new SMNException("SDK.UpdateSmsEventRequestException", "UpdateSmsEventRequestException: callback is invalid");
        }
        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}'), array($this->projectId), Constants::SMS_EVENT_API_URI));
        return join($url);
    }

    public function getMethod()
    {
        return Http::PUT;
    }

    /**
     * @param $callback array
     * @return $this
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
        $this->bodyParams["callback"] = $callback;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCallback()
    {
        return $this->callback;
    }
}