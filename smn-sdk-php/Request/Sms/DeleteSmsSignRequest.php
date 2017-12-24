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

namespace SMN\Request\Sms;

use Http\Http as Http;
use SMN\Request\AbstractRequest as AbstractRequest;
use SMN\Common\Constants as Constants;

/**
 * Class DeleteSmsSignRequest
 * the request for delete sms sign
 * @package SMN\Request\Sms
 * @author zhangyx
 * @version 1.0.1
 */
class DeleteSmsSignRequest extends AbstractRequest
{
    private $signId;

    public function getUrl()
    {
        if (empty($this->signId))
        {
            throw new SMNException("SDK.DeleteSmsSignRequestException", "DeleteSmsSignRequestException : signId is null");
        }
        return str_replace(array('{regionName}', '{projectId}', '{signId}'),
            array($this->smnConfiguration->getRegionName(), $this->projectId, $this->signId),
            Constants::SMN_BASE_URL . Constants::DELETE_SMS_SING_API_URI);
    }

    public function getMethod()
    {
        return Http::DELETE;
    }

    /**
     * @param $signId
     * @return $this
     */
    public function setSignId($signId)
    {
        $this->signId = $signId;
        return $this;
    }
}