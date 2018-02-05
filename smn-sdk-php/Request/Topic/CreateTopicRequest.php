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
use SMN\Common\Constants as Constants;
use SMN\Common\Util\ValidateUtil as ValidateUtil;
use SMN\Exception\SMNException as SMNException;
use SMN\Request\AbstractRequest as AbstractRequest;

/**
 * Class CreateTopicRequest
 * the request to create topic
 * @package SMN\Request\Topic
 * @author zhangyx
 * @version 1.1.0
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

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}'), array($this->projectId), Constants::TOPIC_COMMON_API_URI));
        return join($url);
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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }
}