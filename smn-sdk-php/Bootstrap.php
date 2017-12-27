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
namespace SMN;
/**
 * simple class for Bootstrap.
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
 * 初始化类定义
 *
 * @author sunzhixi
 */
class Bootstrap
{
    public static function init()
    {
        self::initHttp();
    }
    public static function initHttp()
    {
        require_once(__DIR__ . '/Core/Http/Bootstrap.php');
        \Http\Bootstrap::init();
    }
}
Bootstrap::init();
?>
