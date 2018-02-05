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

namespace SMN\Request;

use SMN\Common\Constants as Constants;

/**
 * Class AbstractRequest
 * @package SMN\Request
 * @author zhangyx
 * @version 1.1.0
 */
abstract class AbstractRequest
{
    protected $projectId;
    protected $regionName;
    protected $smnConfiguration;
    protected $clientConfiguration;

    protected $bodyParams = array();
    protected $headers = array();
    protected $queryParams = array();

    /**
     * get url of request
     * @return mixed
     */
    public abstract function getUrl();

    /**
     * get method of request
     * @return mixed
     */
    public abstract function getMethod();

    /**get headers of request
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    public function getBodyParams()
    {
        return $this->bodyParams;
    }

    public function getContentType()
    {
        return "json";
    }

    /**
     * get expect type of request
     * @return string
     */
    public function getExpectType()
    {
        return "json";
    }

    /**
     * add header to request
     * @param $key
     * @param $value
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     * @param string $regionName
     */
    public function setRegionName($regionName)
    {
        $this->regionName = $regionName;
    }

    /**
     * @param string $projectId
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }

    /**
     * @param SmnConfiguration $smnConfiguration
     */
    public function setSmnConfiguration($smnConfiguration)
    {
        $this->smnConfiguration = $smnConfiguration;
    }

    /**
     * @param ClientConfiguration $clientConfiguration
     */
    public function setClientConfiguration($clientConfiguration)
    {
        $this->clientConfiguration = $clientConfiguration;
    }

    /**
     * get query string
     * @return string
     */
    public function getQueryString()
    {
        $requestUrl = '';
        foreach ($this->queryParams as $key => $value) {
            $requestUrl .= "$key=" . urlencode($value) . "&";
        }
        if ($requestUrl != '') {
            $requestUrl = '?' . $requestUrl;
        }
        return substr($requestUrl, 0, -1);
    }

    /**
     * @return string smn service url
     */
    public function getSmnServiceUrl()
    {
        if (!empty($this->clientConfiguration) && !empty($this->clientConfiguration->getSmnHostUrl())) {
            return $this->clientConfiguration->getSmnHostUrl();
        }

        return str_replace(array('{regionName}', '{projectId}'),
            array($this->smnConfiguration->getRegionName(), $this->projectId),
            Constants::SMN_BASE_URL);
    }

    /**
     * @return string iam service url
     */
    public function getIamServiceUrl()
    {
        if (!empty($this->clientConfiguration) && !empty($this->clientConfiguration->getIamHostUrl())) {
            return $this->clientConfiguration->getIamHostUrl();
        }
        return str_replace(array("{regionName}"), array($this->smnConfiguration->getRegionName()), Constants::AUTH_BASE_URL);
    }

    /**
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return string
     */
    public function getRegionName()
    {
        return $this->regionName;
    }
}