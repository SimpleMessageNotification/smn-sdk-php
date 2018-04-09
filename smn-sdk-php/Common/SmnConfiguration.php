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

namespace SMN\Common;

define ('SDK_USER_AGENT', 'smn-sdk-php/1.1.2', true);
/**
 * Class SmnConfiguration
 * @package SMN\Common
 * @author zhangyx
 * @version 1.1.0
 */
class SmnConfiguration
{
    private $username;
    private $domainName;
    private $password;
    private $regionName;

    /**
     * SmnConfiguration constructor.
     * @param $username
     * @param $domainName
     * @param $password
     * @param $regionName
     */
    public function __construct($username, $domainName, $password, $regionName)
    {
        $this->username = $username;
        $this->domainName = $domainName;
        $this->password = $password;
        $this->regionName = $regionName;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getDomainName()
    {
        return $this->domainName;
    }

    /**
     * @param mixed $domainName
     */
    public function setDomainName($domainName)
    {
        $this->domainName = $domainName;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRegionName()
    {
        return $this->regionName;
    }

    /**
     * @param mixed $regionName
     */
    public function setRegionName($regionName)
    {
        $this->regionName = $regionName;
    }

}