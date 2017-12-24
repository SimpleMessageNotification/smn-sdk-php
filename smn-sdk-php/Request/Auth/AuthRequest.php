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

namespace SMN\Request\Auth;

use Http\Http as Http;
use SMN\Request\AbstractRequest as AbstractRequest;
use SMN\Common\Constants as Constants;

class AuthRequest extends AbstractRequest
{
    public function getUrl()
    {
        return str_replace(array("{regionName}"), array($this->smnConfiguration->getRegionName()), Constants::AUTH_URL);
    }

    public function getBodyParams()
    {
        return str_replace(array("{userName}", "{password}", "{domainName}", "{regionName}"),
            array($this->smnConfiguration->getUsername(), $this->smnConfiguration->getPassword(),
                $this->smnConfiguration->getDomainName(), $this->smnConfiguration->getRegionName()),
            Constants::AUTH_JSON);
    }

    public function getMethod()
    {
        return Http::POST;
    }
}