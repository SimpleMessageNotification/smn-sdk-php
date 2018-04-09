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
 * Class SmsBatchPublishWithDiffMessageRequest
 * the request message for batch send notification or verify sms with different message
 * @package SMN\Request\Auth
 * @author zhangyx
 * @version 1.1.2
 */
class SmsBatchPublishWithDiffMessageRequest extends AbstractRequest
{
    /**
     * sms messages
     */
    private $smsMessages;

    public function getUrl()
    {
        if (empty($this->smsMessages)) {
            throw new SMNException("SDK.SmsBatchPublishWithDiffMessageRequestException", "SmsBatchPublishWithDiffMessageRequestException : smsMessages is empty.");
        }

        if (count($this->smsMessages) > Constants::MAX_SMS_BATCH_PUBLISH_SIZE) {
            throw new SMNException("SDK.SmsBatchPublishWithDiffMessageRequestException", "SmsBatchPublishWithDiffMessageRequestException : smsMessages size must be less than 1000.");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}'), array($this->projectId), Constants::SMS_BATCH_PUBLISH_WITH_DIFF_MESSAGE));
        return join($url);
    }

    public function getMethod()
    {
        return Http::POST;
    }

    /**
     * @return array
     */
    public function getSmsMessages()
    {
        return $this->smsMessages;
    }

    /**
     * @param array $smsMessages
     * @return $this
     */
    public function setSmsMessages($smsMessages)
    {
        $this->smsMessages = $smsMessages;
        $this->bodyParams["sms_message"] = $smsMessages;
        return $this;
    }
}