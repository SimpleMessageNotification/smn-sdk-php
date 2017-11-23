<?php
/**
 * Copyright (C) 2017. Huawei Technologies Co., LTD. All rights reserved.
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
use SMN\Common\Config  as Config;
use SMN\Auth\AuthToken as AuthToken;
use Http\HttpHelper    as HttpHelper;
use Http\Http          as Http;
use SMN\Exception\SMNException as SMNException;
/**
 * Clean, simple class for SMN Cloud Account.
 * in PHP.
 *
 * There is an emphasis of readability without loosing concise
 * syntax.  As such, you will notice that the library lends
 * itself very nicely to "chaining".  You will see several "alias"
 * methods: more readable method definitions that wrap
 * their more concise counterparts.  You will also notice
 * no public constructor.  This two adds to the readability
 * and "chainabilty" of the library.
 *
 * SMN 租户类定义
 * 成员变量authToken保存从IAM获取Token值，每次访问都会检查有效时间。
 * @author sunzhixi
 */
class CloudAccount
{
    private $userName;
    private $password;
    private $domainName;
    private $regionId;
    private $authToken;
    public function __construct($userName,$password,$domainName,$regionId)
    {    
        $this->userName = $userName;
        $this->password = $password;
        $this->domainName = $domainName;
        $this->regionId = $regionId;
    }
    public function getUserName()
    {    
        return $this->userName;
    }
    public function setUserName($userName)
    {    
        $this->userName=$userName;
    }
    public function getPassword()
    {    
        return $this->password;
    }
    public function setPassword($password)
    {    
        $this->password=$password;
    }
    public function getDomainName()
    {    
        return $this->domainName;
    }
    public function setDomainName($domainName)
    {    
        $this->domainName=$domainName;
    }
    public function getRegionId()
    {    
        return $this->regionId;
    }
    public function setRegionId($regionId)
    {    
        $this->regionId=$regionId;
    }
    public function setAuthToken($secretToken,$token)
    {    
        $this->authToken = new AuthToken($secretToken,$token);
    }
    public function getTokenFromRemote()
    {
        $url=Config::$authUrl;
        $url=str_replace(array("{regionId}"),array($this->getRegionId()),$url);
        $auth_json_tmpl=Config::$authJson;
        $auth_json = str_replace(array("{userName}","{password}","{domainName}","{regionId}"),array($this->userName,$this->password,$this->domainName,$this->regionId),$auth_json_tmpl);
        $httpHelper = HttpHelper::init()->addHeader('User-Agent',Config::$version)->uri($url)->method(Http::POST)->body($auth_json,"json")->expects("json")->withoutStrictSSL();
        if(!is_null(Config::$proxy_host) && !is_null(Config::$proxy_port))
        {
            $httpHelper = $httpHelper->useProxy(Config::$proxy_host,Config::$proxy_port);
        }
        try
        {
            $response = $httpHelper->send();
        }
        catch(\Exception $exception)
        {
            throw new SMNException("SDK.ServerException",$exception->getMessage());
        }
        $Headers=$response->headers->toArray();
        $secretToken=isset($Headers['X-Subject-Token']) ? $Headers['X-Subject-Token'] : NULL;
        if(is_null($secretToken))
        {
            throw new SMNException("SDK.AuthException","SDK.AuthException : Authentication failure!");
        }
        $token = $response->body;
        $this->setAuthToken($secretToken,$token); 
    }
    public function getAuthToken()
    {    
        if(empty($this->authToken) || is_null($this->authToken) || $this->authToken->isExpired())
        {
            $this->getTokenFromRemote();
        }
        return $this->authToken;
    }
}
?>
