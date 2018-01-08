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
use SMN\Common\Util\ValidateUtil;
use SMN\Request\AbstractRequest as AbstractRequest;
use SMN\Exception\SMNException as SMNException;

/**
 * Class SmsPublishRequest
 * the request message for sms publish
 * @package SMN\Request\Auth
 * @author zhangyx
 * @version 1.1.0
 */
class SmsPublishRequest extends AbstractRequest
{
    private $endpoint;
    private $message;
    private $signId;

    public function getUrl()
    {
        if (empty($this->message)) {
            throw new SMNException("SDK.SmsPublishRequestException", "SmsPublishRequestException : No Message!");
        }

        if (empty($this->signId)) {
            throw new SMNException("SDK.SmsPublishRequestException", "SmsPublishRequestException : empty signId!");
        }

        if (empty($this->endpoint)) {
            throw new SMNException("SDK.SmsPublishRequestException", "SmsPublishRequestException : phone number is invalid");
        }

        return str_replace(array('{regionName}', '{projectId}'),
            array($this->smnConfiguration->getRegionName(), $this->projectId),
            Constants::SMN_BASE_URL . Constants::SMS_PUBLISH_API_URI);

    }

    public function getMethod()
    {
        return Http::POST;
    }

    /**
     * @param mixed $endpoint
     * @return $this
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        $this->bodyParams["endpoint"] = $endpoint;
        return $this;
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
}
