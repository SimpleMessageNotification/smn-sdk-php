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

namespace SMN\Client;

use SMN\Auth\IamAuth as IamAuth;
use SMN\Common\ClientConfiguration as ClientConfiguration;
use SMN\Common\SmnConfiguration as SmnConfiguration;
use SMN\Core\RestClient as RestClient;
use SMN\Exception\SMNException as SMNException;
use SMN\Response\Response as Response;

/**
 * Class DefaultSmnClient
 * @package SMN\Client
 * @author zhangyx
 * @version 1.1.0
 */
class DefaultSmnClient implements SmnClient
{
    private $smnConfiguration;
    private $auth;
    private $clientConfiguration;

    public function __construct($username, $domainName, $password, $regionName)
    {
        $this->smnConfiguration = new SmnConfiguration($username, $domainName, $password, $regionName);
        $this->auth = new IamAuth($this->smnConfiguration);
        $this->clientConfiguration = new ClientConfiguration();
    }

    /**
     * @param $request
     * @return mixed|Response
     * @throws SMNException
     */
    public function sendRequest($request)
    {
        list($projectId, $secureToken) = $this->auth->getTokenAndProject();
        $request->setSmnConfiguration($this->smnConfiguration);
        $request->setClientConfiguration($this->clientConfiguration);
        $this->addParamsAndHeader($request, $projectId, $secureToken);

        $response = RestClient::getResponse($request, $this->clientConfiguration);

        // clean token if is no permission
        if (RestClient::isNoPermission($response)) {
            $this->cleanToken();
        }

        return new Response($request, $response);
    }

    private function addParamsAndHeader($request, $projectId, $secureToken)
    {
        if (empty($projectId) || empty($secureToken)) {

            throw new SMNException("SDK.InvalidProjectToken", "token or projectId is invalid");
        }
        $request->setProjectId($projectId);
        $request->addHeader("region", $this->smnConfiguration->getRegionName());
        $request->addHeader("X-Auth-Token", $secureToken);
        $request->addHeader("X-Project-Id", $projectId);
        $request->addHeader("User-Agent", SDK_USER_AGENT);
        $request->addHeader("X-Smn-Sdk", SDK_USER_AGENT);
    }

    /**
     * @param mixed $clientConfiguration
     */
    public function setClientConfiguration($clientConfiguration)
    {
        if (empty($clientConfiguration) || is_null($clientConfiguration)) {
            $clientConfiguration = new ClientConfiguration();
        }
        $this->clientConfiguration = $clientConfiguration;
        $this->auth->setClientConfiguration($clientConfiguration);
    }

    /**
     * clean token
     */
    public function cleanToken()
    {
        if (!is_null($this->auth)) {
            $this->auth->cleanToken();
        }
    }
}