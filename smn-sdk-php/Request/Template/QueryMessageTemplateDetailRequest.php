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
use SMN\Request\AbstractRequest as AbstractRequest;
use SMN\Common\Constants as Constants;
use SMN\Exception\SMNException as SMNException;

/**
 * Class QueryMessageTemplateDetailRequest
 * the request to query message template detail
 * @package SMN\Request\Template
 * @author zhangyx
 * @version 1.1.0
 */
class QueryMessageTemplateDetailRequest extends AbstractRequest
{
    private $messageTemplateId;

    public function getUrl()
    {
        if (empty($this->messageTemplateId)) {
            throw new SMNException("SDK.QueryMessageTemplateDetailRequestException", "QueryMessageTemplateDetailRequestException :  message template id is invalid");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}', '{messageTemplateId}'),
            array($this->projectId, $this->messageTemplateId), Constants::MESSAGE_TEMPLATE_ID_API_URI));
        return join($url);
    }

    public function getMethod()
    {
        return Http::GET;
    }

    /**
     * @param mixed $messageTemplateId
     * @return QueryMessageTemplateDetailRequest
     */
    public function setMessageTemplateId($messageTemplateId)
    {
        $this->messageTemplateId = $messageTemplateId;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessageTemplateId()
    {
        return $this->messageTemplateId;
    }
}