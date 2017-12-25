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

/**
 * Class PublishWithStructureRequest
 * the request to publish message with message structure
 * @package SMN\Request\Topic
 * @author zhangyx
 * @version 1.1.0
 */
class PublishWithStructureRequest extends AbstractRequest
{
    private $topicUrn;
    private $messageStructure;
    private $subject;

    public function getUrl()
    {
        if (empty($this->topicUrn)) {
            throw new SMNException("SDK.PublishWithStructureRequestException", "PublishWithStructureRequestException : topic urn is null");
        }

        if (!ValidateUtil::validateSubject($this->subject)) {
            throw new SMNException("SDK.PublishWithStructureRequestException", "PublishWithStructureRequestException : subject is invalid");
        }

        if (!ValidateUtil::validateMessageStructure($this->messageStructure)) {
            throw new SMNException("SDK.PublishWithStructureRequestException", "PublishWithStructureRequestException : message structure is invalid");
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
     * @param $messageStructure
     * @return $this
     */
    public function setMessageStructure($messageStructure)
    {
        $this->messageStructure = $messageStructure;
        $this->bodyParams["message_structure"] = $messageStructure;
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