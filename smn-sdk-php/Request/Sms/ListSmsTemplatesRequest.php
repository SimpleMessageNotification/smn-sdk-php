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
use SMN\Common\Util\ValidateUtil as ValidateUtil;
use SMN\Exception\SMNException as SMNException;
use SMN\Request\AbstractRequest as AbstractRequest;

/**
 * Class ListSmsTemplatesRequest
 * the request to list sms templates
 * @package SMN\Request\Sms
 * @author zhangyx
 * @version 1.1.1
 */
class ListSmsTemplatesRequest extends AbstractRequest
{

    /**
     * offset
     */
    private $offset = Constants::DEFAULT_OFFSET;

    /**
     * limit
     */
    private $limit = Constants::DEFAULT_LIMIT;

    /**
     * sms template name
     */
    private $smsTemplateName;

    /**
     * sms template type
     */
    private $smsTemplateType;

    /**
     * status
     */
    private $status;

    /**
     * get url of request
     * @return string
     */
    public function getUrl()
    {
        if (!ValidateUtil::validateLimit($this->limit)) {
            throw new SMNException("SDK.ListSmsTemplatesRequestException", "ListSmsTemplatesRequestException : limit is invalid");
        }
        if (!ValidateUtil::validateOffset($this->offset)) {
            throw new SMNException("SDK.ListSmsTemplatesRequestException", "ListSmsTemplatesRequestException : offset is invalid");

        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}'), array($this->projectId), Constants::SMS_TEMPLATE_API_URI));
        array_push($url, parent::getQueryString());
        return join($url);
    }

    /**
     * get method of request
     * @return mixed
     */
    public function getMethod()
    {
        return Http::GET;
    }

    /**
     * @param $offset
     * @return ListSmsTemplatesRequest
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->queryParams["offset"] = $offset;
        return $this;
    }

    /**
     * @param $limit
     * @return ListSmsTemplatesRequest
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        $this->queryParams["limit"] = $limit;
        return $this;
    }

    /**
     * @param string $smsTemplateName
     * @return ListSmsTemplatesRequest
     */
    public function setSmsTemplateName($smsTemplateName)
    {
        $this->smsTemplateName = $smsTemplateName;
        $this->queryParams["sms_template_name"] = $smsTemplateName;
        return $this;
    }

    /**
     * @param int $smsTemplateType
     * @return ListSmsTemplatesRequest
     */
    public function setSmsTemplateType($smsTemplateType)
    {
        $this->smsTemplateType = $smsTemplateType;
        $this->queryParams["sms_template_type"] = $this->smsTemplateType;
        return $this;
    }

    /**
     * @param mixed $status
     * @return ListSmsTemplatesRequest
     */
    public function setStatus($status)
    {
        $this->status = $status;
        $this->queryParams["status"] = $this->status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return mixed
     */
    public function getSmsTemplateName()
    {
        return $this->smsTemplateName;
    }

    /**
     * @return mixed
     */
    public function getSmsTemplateType()
    {
        return $this->smsTemplateType;
    }
}