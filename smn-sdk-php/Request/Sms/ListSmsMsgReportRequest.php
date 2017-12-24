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
use SMN\Common\Constants as Constants;
use SMN\Common\Util\ValidateUtil as ValidateUtil;
use SMN\Request\AbstractRequest as AbstractRequest;
use SMN\Exception\SMNException as SMNException;

/**
 * Class ListSmsMsgReportRequest
 * the request for list sms msg report
 * @package SMN\Request\Sms
 * @author zhangyx
 * @version 1.0.1
 */
class ListSmsMsgReportRequest extends AbstractRequest
{
    private $startTime;
    private $endTime;
    private $signId;
    private $mobile;
    private $status;
    private $offset = Constants::DEFAULT_OFFSET;
    private $limit = Constants::DEFAULT_LIMIT;

    /**
     * ListSmsMsgReportRequest constructor.
     */
    public function __construct()
    {
        $this->offset = Constants::DEFAULT_OFFSET;
        $this->limit = Constants::DEFAULT_LIMIT;
        $this->queryParams["offset"] = $this->offset;
        $this->queryParams["limit"] = $this->limit;
    }

    public function getUrl()
    {
        if (!ValidateUtil::validateLimit($this->limit)) {
            throw new SMNException("SDK.ListSmsMsgReportRequestException", "ListSmsMsgReportRequestException : limit is invalid");
        }
        if (!ValidateUtil::validateOffset($this->offset)) {
            throw new SMNException("SDK.ListSmsMsgReportRequestException", "ListSmsMsgReportRequestException : offset is invalid");

        }
        return str_replace(array('{regionName}', '{projectId}'),
                array($this->smnConfiguration->getRegionName(), $this->projectId),
                Constants::SMN_BASE_URL . Constants::SMS_MSG_REPORT_API_URI) . parent::getQueryString();
    }

    public function getMethod()
    {
        return Http::GET;
    }

    /**
     * @param $startTime
     * @return $this
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        $this->queryParams["start_time"] = $startTime;
        return $this;
    }

    /**
     * @param $endTime
     * @return $this
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        $this->queryParams["end_time"] = $endTime;
        return $this;
    }

    /**
     * @param $signId
     * @return $this
     */
    public function setSignId($signId)
    {
        $this->signId = $signId;
        $this->queryParams["sign_id"] = $signId;
        return $this;
    }

    /**
     * @param $mobile
     * @return $this
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        $this->queryParams["mobile"] = $mobile;
        return $this;
    }

    /**
     * @param $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        $this->queryParams["status"] = $status;
        return $this;
    }

    /**
     * @param $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->queryParams["offset"] = $offset;
        return $this;
    }

    /**
     * @param $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        $this->queryParams["limit"] = $limit;
        return $this;
    }
}