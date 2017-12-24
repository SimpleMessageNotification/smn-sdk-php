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

namespace SMN\Request\Topic;

use Http\Http as Http;
use SMN\Request\AbstractRequest as AbstractRequest;
use SMN\Common\Constants as Constants;
use SMN\Common\Util\ValidateUtil as ValidateUtil;

/**
 * Class CreateTopicRequest
 * the request to create topic
 * @package SMN\Request\Topic
 * @author zhangyx
 * @version 1.0.1
 */
class CreateTopicRequest extends AbstractRequest
{
    private $name;
    private $displayName;

    public function getUrl()
    {
        if (!ValidateUtil::validateTopicName($this->name)) {
            throw new SMNException("SDK.CreateTopicRequestException", "CreateTopicRequestException : topic name is invalid");
        }

        if (!ValidateUtil::validateDisplayName($this->displayName)) {
            throw new SMNException("SDK.CreateTopicRequestException", "CreateTopicRequestException : topic display name is invalid");
        }

        return str_replace(array('{regionName}', '{projectId}'),
            array($this->smnConfiguration->getRegionName(), $this->projectId),
            Constants::SMN_BASE_URL . Constants::TOPIC_COMMON_API_URI);
    }

    public function getMethod()
    {
        return Http::POST;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->bodyParams["name"] = $name;
        return $this;
    }

    /**
     * @param $displayName
     * @return $this
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        $this->bodyParams["display_name"] = $displayName;
        return $this;
    }
}