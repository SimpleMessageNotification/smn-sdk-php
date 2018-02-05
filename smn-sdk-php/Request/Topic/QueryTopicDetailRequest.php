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
use SMN\Exception\SMNException as SMNException;
use SMN\Request\AbstractRequest as AbstractRequest;

/**
 * Class QueryTopicDetailRequest
 * the request to query topic detail
 * @package SMN\Request\Topic
 * @author zhangyx
 * @version 1.1.0
 */
class QueryTopicDetailRequest extends AbstractRequest
{

    private $topicUrn;

    public function getUrl()
    {
        if (empty($this->topicUrn)) {
            throw new SMNException("SDK.QueryTopicDetailRequestException", "QueryTopicDetailRequestException : topic urn is null");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}', '{topicUrn}'),
            array($this->projectId, $this->topicUrn), Constants::TOPIC_WITH_URN_API_URI));
        return join($url);
    }

    public function getMethod()
    {
        return Http::GET;
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
     * @return string
     */
    public function getTopicUrn()
    {
        return $this->topicUrn;
    }
}