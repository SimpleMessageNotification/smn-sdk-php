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

namespace SMN\Request\Topic;

use Http\Http as Http;
use SMN\Request\AbstractRequest as AbstractRequest;
use SMN\Common\Constants as Constants;

/**
 * Class DeleteTopicAttributeByNameRequest
 * the request to delete topic attribute
 * @package SMN\Request\Topic
 * @author zhangyx
 * @version 1.1.0
 */
class DeleteTopicAttributeByNameRequest extends AbstractRequest
{
    private $topicUrn;
    private $name;

    public function getUrl()
    {
        if (empty($this->topicUrn)) {
            throw new SMNException("SDK.DeleteTopicAttributeByNameRequestException", "DeleteTopicAttributeByNameRequestException : topic urn is null");
        }

        if (empty($this->name)) {
            throw new SMNException("SDK.DeleteTopicAttributeByNameRequestException", "DeleteTopicAttributeByNameRequestException : name is null");
        }

        return str_replace(array('{regionName}', '{projectId}', '{topicUrn}', '{name}'),
            array($this->smnConfiguration->getRegionName(), $this->projectId, $this->topicUrn, $this->name),
            Constants::SMN_BASE_URL . Constants::TOPIC_ATTRIBUTES_WITH_NAME_API_URI);
    }

    public function getMethod()
    {
        return Http::DELETE;
    }

    /**
     * @param $topicUrn
     * @return $this
     */
    public function setTopicUrn($topicUrn)
    {
        $this->topicUrn = $topicUrn;
        return $this;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}