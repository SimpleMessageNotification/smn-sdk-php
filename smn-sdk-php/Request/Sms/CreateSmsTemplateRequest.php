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
use SMN\Request\AbstractRequest as AbstractRequest;
use SMN\Exception\SMNException as SMNException;

/**
 * Class CreateSmsTemplateRequest
 * the request to create sms template
 * @package SMN\Request\Sms
 * @author zhangyx
 * @version 1.1.1
 */
class CreateSmsTemplateRequest extends AbstractRequest
{

    /**
     * sms template name
     */
    private $smsTemplateName;

    /**
     * sms template content
     */
    private $smsTemplateContent;

    /**
     * remark
     */
    private $remark;

    /**
     * sms template type
     */
    private $smsTemplateType;

    /**
     * get url of request
     * @return string
     */
    public function getUrl()
    {
        if (empty($this->smsTemplateContent)) {
            throw new SMNException("SDK.CreateSmsTemplateRequestException", "CreateSmsTemplateRequestException : sms template content is empty.");
        }

        if (empty($this->smsTemplateName)) {
            throw new SMNException("SDK.CreateSmsTemplateRequestException", "CreateSmsTemplateRequestException : sms template name is empty.");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}'), array($this->projectId), Constants::SMS_TEMPLATE_API_URI));
        return join($url);
    }

    /**
     * get method of request
     * @return mixed
     */
    public function getMethod()
    {
        return Http::POST;
    }

    /**
     * @param string $smsTemplateName
     * @return CreateSmsTemplateRequest
     */
    public function setSmsTemplateName($smsTemplateName)
    {
        $this->smsTemplateName = $smsTemplateName;
        $this->bodyParams["sms_template_name"] = $smsTemplateName;
        return $this;
    }

    /**
     * @param string $smsTemplateContent
     * @return CreateSmsTemplateRequest
     */
    public function setSmsTemplateContent($smsTemplateContent)
    {
        $this->smsTemplateContent = $smsTemplateContent;
        $this->bodyParams["sms_template_content"] = $smsTemplateContent;
        return $this;
    }

    /**
     * @param string $remark
     * @return CreateSmsTemplateRequest
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
        $this->bodyParams["remark"] = $remark;
        return $this;
    }

    /**
     * @param int $smsTemplateType
     * @return CreateSmsTemplateRequest
     */
    public function setSmsTemplateType($smsTemplateType)
    {
        $this->smsTemplateType = $smsTemplateType;
        $this->bodyParams["sms_template_type"] = $smsTemplateType;
        return $this;
    }

    /**
     * @return string
     */
    public function getSmsTemplateName()
    {
        return $this->smsTemplateName;
    }

    /**
     * @return string
     */
    public function getSmsTemplateContent()
    {
        return $this->smsTemplateContent;
    }

    /**
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * @return int
     */
    public function getSmsTemplateType()
    {
        return $this->smsTemplateType;
    }
}