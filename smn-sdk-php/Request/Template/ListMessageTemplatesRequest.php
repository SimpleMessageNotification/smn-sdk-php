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
 * Class ListMessageTemplatesRequest
 * the request to list message templates
 * @package SMN\Request\Template
 * @author zhangyx
 * @version 1.1.0
 */
class ListMessageTemplatesRequest extends AbstractRequest
{
    private $protocol;
    private $messageTemplateName;
    private $offset = Constants::DEFAULT_OFFSET;
    private $limit = Constants::DEFAULT_LIMIT;

    /**
     * ListTopicsRequest constructor.
     */
    public function __construct()
    {
        $this->offset = Constants::DEFAULT_OFFSET;
        $this->limit = Constants::DEFAULT_LIMIT;
        $this->queryParams["offset"] = $this->offset;
        $this->queryParams["limit"] = $this->limit;
    }

    /**
     * @return mixed
     * @throws SMNException
     */
    public function getUrl()
    {
        if (!ValidateUtil::validateLimit($this->limit)) {
            throw new SMNException("SDK.ListMessageTemplatesRequestException", "ListMessageTemplatesRequestException : limit is invalid");
        }
        if (!ValidateUtil::validateOffset($this->offset)) {
            throw new SMNException("SDK.ListMessageTemplatesRequestException", "ListMessageTemplatesRequestException : offset is invalid");

        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}'), array($this->projectId), Constants::MESSAGE_TEMPLATE_API_URI));
        array_push($url, parent::getQueryString());
        return join($url);
    }

    public function getMethod()
    {
        return Http::GET;
    }

    /**
     * @param mixed $protocol
     * @return ListMessageTemplatesRequest
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
        $this->queryParams["protocol"] = $protocol;
        return $this;
    }

    /**
     * @param mixed $messageTemplateName
     * @return ListMessageTemplatesRequest
     */
    public function setMessageTemplateName($messageTemplateName)
    {
        $this->messageTemplateName = $messageTemplateName;
        $this->queryParams["message_template_name"] = $messageTemplateName;
        return $this;
    }

    /**
     * @param $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->queryParams["offset"] = $offset;
        return $this;
    }

    /**
     * @param $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        $this->queryParams["limit"] = $limit;
        return $this;
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

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }
}