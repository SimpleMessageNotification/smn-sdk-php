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

namespace SMN\Request\Subscription;

use Http\Http as Http;
use SMN\Request\AbstractRequest as AbstractRequest;
use SMN\Common\Constants as Constants;
use SMN\Exception\SMNException as SMNException;

/**
 * Class SubscribeRequest
 * the request for subscription
 * @package SMN\Request\Subscription
 * @author zhangyx
 * @version 1.1.0
 */
class SubscribeRequest extends AbstractRequest
{
    private $topicUrn;
    private $endpoint;
    private $protocol;
    private $remark;

    /**
     * @return mixed
     * @throws SMNException
     */
    public function getUrl()
    {
        if (empty($this->topicUrn)) {
            throw new SMNException("SDK.SubscribeRequestException", "SubscribeRequestException : topic urn is null");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}', '{topicUrn}'), array($this->projectId, $this->topicUrn), Constants::SUBSCRIPTIONS_TOPIC_API_URI));
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
     * @param mixed $topicUrn
     * @return SubscribeRequest
     */
    public function setTopicUrn($topicUrn)
    {
        $this->topicUrn = $topicUrn;
        return $this;
    }

    /**
     * @param mixed $endpoint
     * @return SubscribeRequest
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        $this->bodyParams["endpoint"] = $endpoint;
        return $this;
    }

    /**
     * @param mixed $protocol
     * @return SubscribeRequest
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
        $this->bodyParams["protocol"] = $protocol;
        return $this;
    }

    /**
     * @param mixed $remark
     * @return SubscribeRequest
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
        $this->bodyParams["remark"] = $remark;
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
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }
}