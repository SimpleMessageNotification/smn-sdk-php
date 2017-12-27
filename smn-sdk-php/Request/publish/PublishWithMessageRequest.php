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

namespace SMN\Request\Publish;

use Http\Http as Http;
use SMN\Request\AbstractRequest as AbstractRequest;
use SMN\Common\Constants as Constants;
use SMN\Common\Util\ValidateUtil as ValidateUtil;
use SMN\Exception\SMNException as SMNException;

/**
 * Class PublishWithMessageRequest
 * the request to publish with message
 * @package SMN\Request\Topic
 * @author zhangyx
 * @version 1.1.0
 */
class PublishWithMessageRequest extends AbstractRequest
{
    private $topicUrn;
    private $message;
    private $subject;

    public function getUrl()
    {
        if (empty($this->topicUrn)) {
            throw new SMNException("SDK.PublishWithMessageRequestException", "PublishWithMessageRequestException : topic urn is null");
        }

        if (!ValidateUtil::validateSubject($this->subject)) {
            throw new SMNException("SDK.PublishWithMessageRequestException", "PublishWithMessageRequestException : subject is invalid");
        }

        if (!ValidateUtil::validateMessage($this->message)) {
            throw new SMNException("SDK.PublishWithMessageRequestException", "PublishWithMessageRequestException : message is invalid");
        }

        return str_replace(array('{regionName}', '{projectId}', '{topicUrn}'),
            array($this->smnConfiguration->getRegionName(), $this->projectId, $this->topicUrn),
            Constants::SMN_BASE_URL . Constants::PUBLISH_API_URI);
    }

    public function getMethod()
    {
        return Http::POST;
    }

    /**
     * @param $topicUrn
     * @return $this
     */
    public function setTopicUrn($topicUrn)
    {
        $this->topicUrn = $topicUrn;
        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        $this->bodyParams["message"] = $message;
        return $this;
    }

    /**
     * @param $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        $this->bodyParams["subject"] = $subject;
        return $this;
    }
}