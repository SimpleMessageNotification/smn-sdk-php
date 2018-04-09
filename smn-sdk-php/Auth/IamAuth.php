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

namespace SMN\Auth;

use SMN\Common\SmnConfiguration as SmnConfiguration;
use SMN\Core\RestClient as RestClient;
use SMN\Exception\SMNException as SMNException;
use SMN\Request\Auth\AuthRequest as AuthRequest;

/**
 * Class IamAuth
 * User authentication
 * @package SMN\IamAuth
 * @author zhangyx
 * @version 1.1.0
 */
class IamAuth
{
    private $projectId;
    private $secretToken;
    private $expireTime;
    private $smnConfiguration;
    private $clientConfiguration;

    private $timezone;
    private $dateTimeFormat = 'Y-m-d\TH:i:s.u\Z';

    /**
     * IamAuth constructor.
     *
     * @param $smnConfiguration
     */
    public function __construct($smnConfiguration)
    {
        $this->timezone = new \DateTimeZone('UTC');
        $this->smnConfiguration = $smnConfiguration;
    }

    /**
     * @param SmnConfiguration $smnConfiguration
     */
    public function setSmnConfiguration($smnConfiguration)
    {
        $this->smnConfiguration = $smnConfiguration;
    }

    /**
     * @param mixed $clientConfiguration
     */
    public function setClientConfiguration($clientConfiguration)
    {
        $this->clientConfiguration = $clientConfiguration;
    }

    /**
     * get token and project
     * @return array
     */
    public function getTokenAndProject()
    {
        if (empty($this->secretToken) || is_null($this->secretToken) || $this->isExpired()) {
            $this->postForToken();
        }

        $tokenProject[] = $this->projectId;
        $tokenProject[] = $this->secretToken;
        return $tokenProject;
    }

    /**
     * clean cache token
     */
    public function cleanToken()
    {
        $this->secretToken = null;
    }

    private function isExpired()
    {
        $now = new \DateTime("now", $this->timezone);
        return $this->expireTime < $now;
    }

    private function postForToken()
    {
        $authRequest = new AuthRequest();
        $authRequest->setSmnConfiguration($this->smnConfiguration);
        $authRequest->setClientConfiguration($this->clientConfiguration);
        $authRequest->addHeader("User-Agent", SDK_USER_AGENT);
        $authRequest->addHeader("X-Smn-Sdk", SDK_USER_AGENT);

        $response = RestClient::getResponse($authRequest, $this->clientConfiguration);
        if (!RestClient::isSuccess($response->code)) {
            throw new SMNException("SDK.AuthException", "SDK.AuthException : Authentication failure!");
        }

        $Headers = $response->headers->toArray();
        $this->secretToken = isset($Headers['X-Subject-Token']) ? $Headers['X-Subject-Token'] : NULL;
        if (is_null($this->secretToken)) {
            throw new SMNException("SDK.AuthException", "SDK.AuthException : Authentication failure!");
        }
        $token = $response->body;
        $this->projectId = $token->token->project->id;
        $expiredAt = $token->token->expires_at;
        $this->expireTime = $this->getExpireTime($expiredAt);
    }

    private function getExpireTime($expiredAt)
    {
        $expires_at = \DateTime::CreateFromFormat($this->dateTimeFormat, $expiredAt, $this->timezone);
        $m = new \DateInterval('PT30M');
        $expires_at->sub($m);
        return $expires_at;
    }
}