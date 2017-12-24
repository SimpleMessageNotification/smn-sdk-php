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
use SMN\Request\AbstractRequest as AbstractRequest;
use SMN\Common\Constants as Constants;

/**
 * Class ListSmsEventRequest
 * the request to list sms event
 * @package SMN\Request\Sms
 * @author zhangyx
 * @version 1.0.1
 */
class ListSmsEventRequest extends AbstractRequest
{

    private $eventType;

    public function getUrl()
    {
        return str_replace(array('{regionName}', '{projectId}'),
            array($this->smnConfiguration->getRegionName(), $this->projectId),
            Constants::SMN_BASE_URL . Constants::SMS_EVENT_API_URI) . parent::getQueryString();
    }

    public function getMethod()
    {
        return Http::GET;
    }

    /**
     * @param $eventType
     * @return $this
     */
    public function setEventType($eventType)
    {
        $this->eventType = $eventType;
        $this->queryParams["event_type"] = $eventType;
        return $this;
    }
}