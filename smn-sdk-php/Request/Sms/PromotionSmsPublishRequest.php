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
 * Class PromotionSmsPublishRequest
 * the request to publish promotion sms
 * @package SMN\Request\Sms
 * @author zhangyx
 * @version 1.1.1
 */
class PromotionSmsPublishRequest extends AbstractRequest
{
    /**
     * endpoints
     */
    private $endpoints;
    /**
     * sms template id
     */
    private $smsTemplateId;
    /**
     * sign id
     */
    private $signId;

    /**
     * get url of request
     * @return string
     */
    public function getUrl()
    {
        if (empty($this->endpoints)) {
            throw new SMNException("SDK.PromotionSmsPublishRequestException", "PromotionSmsPublishRequestException : endpoints is empty.");
        }

        if (empty($this->signId)) {
            throw new SMNException("SDK.PromotionSmsPublishRequestException", "PromotionSmsPublishRequestException : sign id is empty.");
        }

        if (empty($this->smsTemplateId)) {
            throw new SMNException("SDK.PromotionSmsPublishRequestException", "PromotionSmsPublishRequestException : sms template id is empty.");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}'), array($this->projectId), Constants::PROMOTION_SMS_PUBLISH_API_URI));
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
     * @param mixed $endpoints
     * @return PromotionSmsPublishRequest
     */
    public function setEndpoints($endpoints)
    {
        $this->endpoints = $endpoints;
        $this->bodyParams["endpoints"] = $endpoints;
        return $this;
    }

    /**
     * @param mixed $smsTemplateId
     * @return PromotionSmsPublishRequest
     */
    public function setSmsTemplateId($smsTemplateId)
    {
        $this->smsTemplateId = $smsTemplateId;
        $this->bodyParams["sms_template_id"] = $smsTemplateId;
        return $this;
    }

    /**
     * @param mixed $signId
     * @return PromotionSmsPublishRequest
     */
    public function setSignId($signId)
    {
        $this->signId = $signId;
        $this->bodyParams["sign_id"] = $signId;
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
    public function getSignId()
    {
        return $this->signId;
    }

    /**
     * @return string
     */
    public function getSmsTemplateId()
    {
        return $this->smsTemplateId;
    }
}