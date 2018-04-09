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
 * Class SmsBatchPublishRequest
 * the request message for batch send notification or verify sms
 * @package SMN\Request\Auth
 * @author zhangyx
 * @version 1.1.2
 */
class SmsBatchPublishRequest extends AbstractRequest
{
    /**
     * endpoints
     */
    private $endpoints;
    /**
     * sms message
     */
    private $message;
    /**
     * sign id
     */
    private $signId;

    /**
     * message is include signName, default false
     */
    private $messageIncludeSignFlag = false;

    public function getUrl()
    {
        if (empty($this->message)) {
            throw new SMNException("SDK.SmsBatchPublishRequestException", "SmsPublishRequestException : No Message!");
        }

        if (empty($this->endpoints)) {
            throw new SMNException("SDK.SmsBatchPublishRequestException", "SmsPublishRequestException : phone number is invalid");
        }

        if (!$this->messageIncludeSignFlag && empty($this->signId)) {
            throw new SMNException("SDK.SmsBatchPublishRequestException", "SmsPublishRequestException : sign id is null.");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}'), array($this->projectId), Constants::SMS_PUBLISH_API_URI));
        return join($url);
    }

    public function getMethod()
    {
        return Http::POST;
    }

    /**
     * @param mixed $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        $this->bodyParams["message"] = $message;
        return $this;
    }

    /**
     * @param mixed $signId
     * @return $this
     */
    public function setSignId($signId)
    {
        $this->signId = $signId;
        $this->bodyParams["sign_id"] = $signId;
        return $this;
    }

    /**
     * @param bool $messageIncludeSignFlag
     * @return $this
     */
    public function setMessageIncludeSignFlag($messageIncludeSignFlag)
    {
        $this->messageIncludeSignFlag = $messageIncludeSignFlag;
        $this->bodyParams["message_include_sign_flag"] = $messageIncludeSignFlag;
        return $this;
    }

    /**
     * @param array $endpoints
     * @return $this
     */
    public function setEndpoints($endpoints)
    {
        $this->endpoints = $endpoints;
        $this->bodyParams["endpoints"] = $endpoints;
        return $this;
    }

    /**
     * @return array
     */
    public function getEndpoints()
    {
        return $this->endpoints;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getSignId()
    {
        return $this->signId;
    }

    /**
     * @return bool
     */
    public function getMessageIncludeSignFlag()
    {
        return $this->messageIncludeSignFlag;
    }
}