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

use Http\Proxy as Proxy;

/**
 * Clean, simple class for Config.
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
 * 配置常量类定义
 *
 * @author sunzhixi
 * @author zhangyx
 * @version 1.1.0
 */
class ClientConfiguration
{
    // --------------代理设置/proxy parameters----------
    private $proxy_host = null;
    private $proxy_port = null;
    private $proxy_auth_type = null;
    private $auth_username = null;
    private $auth_password = null;
    private $proxy_type = Proxy::HTTP;

    // ----------------超时时间/timeout--------
    // 单位秒，unit s
    private $timeout = null;

    // ---------是否严格进行ssl验证/strict ssl--------
    private $strictSsl = false;

    //-----------客户端证书/client cert--------------
    private $cert = null;
    private $key = null;
    private $passphrase = null;
    private $encoding = 'PEM';

    // ---------------host url--------------------
    // default https://smn.{region}.myhuaweicloud.com
    private $smn_host_url = null;
    //default https://iam.{region}.myhuaweicloud.com
    private $iam_host_url = null;

    /**
     * @return null
     */
    public function getProxyHost()
    {
        return $this->proxy_host;
    }

    /**
     * @param null $proxy_host
     * @return ClientConfiguration
     */
    public function setProxyHost($proxy_host)
    {
        $this->proxy_host = $proxy_host;
        return $this;
    }

    /**
     * @return null
     */
    public function getProxyPort()
    {
        return $this->proxy_port;
    }

    /**
     * @param null $proxy_port
     * @return ClientConfiguration
     */
    public function setProxyPort($proxy_port)
    {
        $this->proxy_port = $proxy_port;
        return $this;
    }

    /**
     * @return null
     */
    public function getProxyAuthType()
    {
        return $this->proxy_auth_type;
    }

    /**
     * @param null $proxy_auth_type
     * @return ClientConfiguration
     */
    public function setProxyAuthType($proxy_auth_type)
    {
        $this->proxy_auth_type = $proxy_auth_type;
        return $this;
    }

    /**
     * @return null
     */
    public function getAuthUsername()
    {
        return $this->auth_username;
    }

    /**
     * @param null $auth_username
     * @return ClientConfiguration
     */
    public function setAuthUsername($auth_username)
    {
        $this->auth_username = $auth_username;
        return $this;
    }

    /**
     * @return null
     */
    public function getAuthPassword()
    {
        return $this->auth_password;
    }

    /**
     * @param null $auth_password
     * @return ClientConfiguration
     */
    public function setAuthPassword($auth_password)
    {
        $this->auth_password = $auth_password;
        return $this;
    }

    /**
     * @return int
     */
    public function getProxyType()
    {
        return $this->proxy_type;
    }

    /**
     * @param int $proxy_type
     * @return ClientConfiguration
     */
    public function setProxyType($proxy_type)
    {
        $this->proxy_type = $proxy_type;
        return $this;
    }

    /**
     * @return null
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param null $timeout
     * @return ClientConfiguration
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @return bool
     */
    public function isStrictSsl()
    {
        return $this->strictSsl;
    }

    /**
     * @param bool $strictSsl
     * @return ClientConfiguration
     */
    public function setStrictSsl($strictSsl)
    {
        $this->strictSsl = $strictSsl;
        return $this;
    }

    /**
     * @return null
     */
    public function getCert()
    {
        return $this->cert;
    }

    /**
     * @param null $cert
     * @return ClientConfiguration
     */
    public function setCert($cert)
    {
        $this->cert = $cert;
        return $this;
    }

    /**
     * @return null
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param null $key
     * @return ClientConfiguration
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return null
     */
    public function getPassphrase()
    {
        return $this->passphrase;
    }

    /**
     * @param null $passphrase
     * @return ClientConfiguration
     */
    public function setPassphrase($passphrase)
    {
        $this->passphrase = $passphrase;
        return $this;
    }

    /**
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * @param string $encoding
     * @return ClientConfiguration
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
        return $this;
    }

    /**
     * @return null
     */
    public function getSmnHostUrl()
    {
        return $this->smn_host_url;
    }

    /**
     * @param null $smn_host_url
     */
    public function setSmnHostUrl($smn_host_url)
    {
        $this->smn_host_url = $smn_host_url;
    }

    /**
     * @return null
     */
    public function getIamHostUrl()
    {
        return $this->iam_host_url;
    }

    /**
     * @param null $iam_host_url
     */
    public function setIamHostUrl($iam_host_url)
    {
        $this->iam_host_url = $iam_host_url;
    }
}