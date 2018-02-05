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

namespace SMN\Request\Template;

use Http\Http as Http;
use SMN\Common\Constants as Constants;
use SMN\Common\Util\ValidateUtil as ValidateUtil;
use SMN\Exception\SMNException as SMNException;
use SMN\Request\AbstractRequest as AbstractRequest;

/**
 * Class CreateTopicRequest
 * the request to create message template
 * @package SMN\Request\Template
 * @author zhangyx
 * @version 1.1.0
 */
class CreateMessageTemplateRequest extends AbstractRequest
{
    private $content;
    private $protocol;
    private $messageTemplateName;

    public function getUrl()
    {
        if (!ValidateUtil::validateTemplateContent($this->content)) {
            throw new SMNException("SDK.CreateMessageTemplateRequestException", "CreateMessageTemplateRequestException : content is invalid");
        }

        if (!ValidateUtil::validateTemplateName($this->messageTemplateName)) {
            throw new SMNException("SDK.CreateMessageTemplateRequestException", "CreateMessageTemplateRequestException : template name is invalid");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}'), array($this->projectId), Constants::MESSAGE_TEMPLATE_API_URI));
        return join($url);
    }

    public function getMethod()
    {
        return Http::POST;
    }

    /**
     * @param mixed $content
     * @return CreateMessageTemplateRequest
     */
    public function setContent($content)
    {
        $this->content = $content;
        $this->bodyParams["content"] = $content;
        return $this;
    }

    /**
     * @param mixed $protocol
     * @return CreateMessageTemplateRequest
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
        $this->bodyParams["protocol"] = $protocol;
        return $this;
    }

    /**
     * @param mixed $messageTemplateName
     * @return CreateMessageTemplateRequest
     */
    public function setMessageTemplateName($messageTemplateName)
    {
        $this->messageTemplateName = $messageTemplateName;
        $this->bodyParams["message_template_name"] = $messageTemplateName;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @return string
     */
    public function getMessageTemplateName()
    {
        return $this->messageTemplateName;
    }
}