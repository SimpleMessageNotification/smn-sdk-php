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

/**
 * Class AbstractRequest
 * @package SMN\Request
 * @author zhangyx
 * @version 1.0.1
 */
abstract class AbstractRequest
{
    protected $projectId;
    protected $regionName;
    protected $smnConfiguration;

    protected $bodyParams = array();
    protected $headers = array();
    protected $queryParams = array();

    public abstract function getUrl();

    public abstract function getMethod();

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

    public function getExpectType()
    {
        return "json";
    }

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

}