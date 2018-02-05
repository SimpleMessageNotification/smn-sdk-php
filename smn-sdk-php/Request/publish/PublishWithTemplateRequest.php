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
 * Class PublishWithTemplateRequest
 * the request to publish message with message template
 * @package SMN\Request\Topic
 * @author zhangyx
 * @version 1.1.0
 */
class PublishWithTemplateRequest extends AbstractRequest
{
    private $topicUrn;
    private $messageTemplateName;
    private $subject;
    private $tags;

    public function getUrl()
    {
        if (empty($this->topicUrn)) {
            throw new SMNException("SDK.PublishWithTemplateRequestException", "PublishWithTemplateRequestException : topic urn is null");
        }

        if (!ValidateUtil::validateSubject($this->subject)) {
            throw new SMNException("SDK.PublishWithTemplateRequestException", "PublishWithTemplateRequestException : subject is invalid");
        }

        if (empty($this->messageTemplateName)) {
            throw new SMNException("SDK.PublishWithTemplateRequestException", "PublishWithTemplateRequestException : message template name is invalid");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}', '{topicUrn}'), array($this->projectId, $this->topicUrn), Constants::PUBLISH_API_URI));
        return join($url);
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
     * @param $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        $this->bodyParams["subject"] = $subject;
        return $this;
    }

    /**
     * @param $messageTemplateName
     * @return $this
     */
    public function setMessageTemplateName($messageTemplateName)
    {
        $this->messageTemplateName = $messageTemplateName;
        $this->bodyParams["message_template_name"] = $messageTemplateName;
        return $this;
    }

    /**
     * @param $tags
     * @return $this
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        $this->bodyParams["tags"] = $tags;
        return $this;
    }

    /**
     * @return string
     */
    public function getTopicUrn()
    {
        return $this->topicUrn;
    }

    /**
     * @return string
     */
    public function getMessageTemplateName()
    {
        return $this->messageTemplateName;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }
}