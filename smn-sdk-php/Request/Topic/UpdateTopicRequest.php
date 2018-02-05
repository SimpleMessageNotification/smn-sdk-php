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
use SMN\Exception\SMNException as SMNException;

/**
 * Class UpdateTopicRequest
 * the request to update topic request
 * @package SMN\Request\Topic
 * @author zhangyx
 * @version 1.1.0
 */
class UpdateTopicRequest extends AbstractRequest
{
    private $topicUrn;
    private $displayName;

    public function getUrl()
    {
        if (empty($this->topicUrn)) {
            throw new SMNException("SDK.UpdateTopicRequestException", "UpdateTopicRequestException : topic urn is null");
        }

        if (!ValidateUtil::validateDisplayName($this->displayName)) {
            throw new SMNException("SDK.UpdateTopicRequestException", "UpdateTopicRequestException : topic display name is invalid");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}', '{topicUrn}'),
            array($this->projectId, $this->topicUrn), Constants::TOPIC_WITH_URN_API_URI));
        return join($url);
    }

    public function getMethod()
    {
        return Http::PUT;
    }

    /**
     * @param $topicUrn
     * @return $this
     */
    public function setTopicUrn($topicUrn)
    {
        $this->topicUrn = $topicUrn;
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
    public function getTopicUrn()
    {
        return $this->topicUrn;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }
}