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
 * Class GetSmsMessageRequest
 * the request to get sms message
 * @package SMN\Request\Sms
 * @author zhangyx
 * @version 1.1.0
 */
class GetSmsMessageRequest extends AbstractRequest
{
    private $messageId;

    public function getUrl()
    {
        if (empty($this->messageId)) {
            throw new SMNException("SDK.GetSmsMessageRequestException", "GetSmsMessageRequestException : messageId is null");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}', '{messageId}'), array($this->projectId, $this->messageId), Constants::GET_SMS_MESSAGE_API_URI));
        return join($url);
    }

    public function getMethod()
    {
        return Http::GET;
    }

    /**
     * @param $messageId
     * @return $this
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessageId()
    {
        return $this->messageId;
    }
}