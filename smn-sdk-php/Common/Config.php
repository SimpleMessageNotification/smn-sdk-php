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
class Config
{
    // --------------代理设置/proxy parameters----------
    public static $proxy_host = null;
    public static $proxy_port = null;
    public static $proxy_auth_type = null;
    public static $auth_username = null;
    public static $auth_password = null;
    public static $proxy_type = Proxy::HTTP;

    // ----------------超时时间/timeout--------
    // 单位秒，unit s
    public static $timeout = null;

    // ---------是否严格进行ssl验证/strict ssl--------
    public static $strictSsl = false;

    //-----------客户端证书/client cert--------------
    public static $cert = null;
    public static $key = null;
    public static $passphrase = null;
    public static $encoding = 'PEM';
}