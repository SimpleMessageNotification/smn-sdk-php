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
 * Class DeleteSmsTemplateRequest
 * the request to delete sms template
 * @package SMN\Request\Sms
 * @author zhangyx
 * @version 1.1.1
 */
class DeleteSmsTemplateRequest extends AbstractRequest
{
    /**
     * sms template id
     */
    private $smsTemplateId;

    /**
     * get url of request
     * @return string
     */
    public function getUrl()
    {
        if (empty($this->smsTemplateId)) {
            throw new SMNException("SDK.DeleteSmsTemplateRequestException", "DeleteSmsTemplateRequestException : sms template id is empty.");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}', '{messageId}'), array($this->projectId, $this->smsTemplateId),
            Constants::SMS_TEMPLATE_MESSAGE_ID_API_URI));
        return join($url);
    }

    /**
     * get method of request
     * @return mixed
     */
    public function getMethod()
    {
        return Http::DELETE;
    }

    /**
     * @param string $smsTemplateId
     * @return DeleteSmsTemplateRequest
     */
    public function setSmsTemplateId($smsTemplateId)
    {
        $this->smsTemplateId = $smsTemplateId;
        return $this;
    }

    /**
     * @return string
     */
    public function getSmsTemplateId()
    {
        return $this->smsTemplateId;
    }
}