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
 * Class UnsubscribeRequest
 * the request for unsubscribe
 * @package SMN\Request\Subscription
 * @author zhangyx
 * @version 1.1.0
 */
class UnsubscribeRequest extends AbstractRequest
{
    private $subscriptionUrn;

    /**
     * @return mixed
     * @throws SMNException
     */
    public function getUrl()
    {
        if (empty($this->subscriptionUrn)) {
            throw new SMNException("SDK.UnsubscribeRequestException", "UnsubscribeRequestException : subscription urn is null");
        }

        $url = array(parent::getSmnServiceUrl());
        array_push($url, str_replace(array('{projectId}', '{subscriptionUrn}'), array($this->projectId, $this->subscriptionUrn), Constants::UNSUBSCRIBE_API_URI));
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
     * @param mixed $subscriptionUrn
     * @return UnsubscribeRequest
     */
    public function setSubscriptionUrn($subscriptionUrn)
    {
        $this->subscriptionUrn = $subscriptionUrn;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubscriptionUrn()
    {
        return $this->subscriptionUrn;
    }
}