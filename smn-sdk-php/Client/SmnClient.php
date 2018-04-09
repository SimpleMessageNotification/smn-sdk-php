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

/**
 * Interface SmnClient
 *
 * @package SMN\Client
 * @author zhangyx
 * @version 1.1.0
 */
interface SmnClient
{
    /**
     * send the request
     *
     * @param $request
     * @return mixed
     */
    public function sendRequest($request);

    /**
     * 清理缓存的token
     *
     * @return void
     */
    public function cleanToken();
}