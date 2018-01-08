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

namespace SMN\Common\Util;

/**
 * Class ValidateUtil
 * validate tool
 * @package SMN\Common\Util
 * @author zhangyx
 * @version 1.1.0
 */
class ValidateUtil
{
    private static $patternPhone = '/^\+?[0-9]{1}[0-9 /\-]{1,31}/';
    private static $patternTopicName = '/^[a-zA-Z0-9]{1}[-_a-zA-Z0-9]{0,255}$/';
    private static $patternSubject = "/^[^\r\n\t\f]+$/";
    private static $maxTopicDisplayName = 192;
    private static $maxSubjectLength = 512;
    private static $maxMessageLength = 262144;
    private static $maxTemplateContent = 262144;
    private static $templateNamePattern = "/^[a-zA-Z0-9]{1}([-_a-zA-Z0-9]){0,64}/";

    /**
     * validate phone
     * @param $phone the phone to validate
     * @return bool|false|int
     */
    public static function validatePhone($phone)
    {
        if (empty($phone)) {
            return false;
        }

        return preg_match(self::$patternPhone, $phone);
    }

    /**
     * validate offset
     * @param $offset the offset to validate
     * @return bool
     */
    public static function validateOffset($offset)
    {
        return $offset >= 0;
    }

    /**
     * validate limit
     * @param $limit the limit to validate
     * @return bool
     */
    public static function validateLimit($limit)
    {
        return $limit > 0 && $limit <= 100;
    }

    /**
     * validate topic name
     * @param $name the topic name to validate
     * @return bool
     */
    public static function validateTopicName($name)
    {
        if (empty($name)) {
            return false;
        }
        return preg_match(self::$patternTopicName, $name);
    }

    /**
     * validate topic display name
     * @param $displayName the display name to validate
     * @return bool
     */
    public static function validateDisplayName($displayName)
    {
        if (empty($displayName)) {
            return true;
        }
        $bytes = self::getBytes($displayName);
        return count($bytes) < self::$maxTopicDisplayName;
    }

    /**
     * validate message subject
     * @param $subject the subject to validate
     * @return bool
     */
    public static function validateSubject($subject)
    {
        if (empty($subject)) {
            return true;
        }
        $bytes = self::getBytes($subject);
        if (count($bytes) > self::$maxSubjectLength) {
            return false;
        }
        return preg_match(self::$patternSubject, $subject);
    }

    /**
     * validate publish message
     * @param $message the publish message to validate
     * @return bool
     */
    public static function validateMessage($message)
    {
        if (empty($message)) {
            return false;
        }
        $bytes = self::getBytes($message);
        return count($bytes) < self::$maxMessageLength;
    }

    /**
     * validate publish message structure
     * @param $message the message structure
     * @return bool
     */
    public static function validateMessageStructure($message)
    {
        if (empty($message)) {
            return false;
        }

        $bytes = self::getBytes($message);
        return count($bytes) < self::$maxMessageLength;
    }

    /**
     * validate message template content
     * @param $content
     * @return bool
     */
    public static function validateTemplateContent($content)
    {
        if (empty($content)) {
            return false;
        }

        $bytes = self::getBytes($content);
        return count($bytes) < self::$maxTemplateContent;
    }

    /**
     * validate template name
     * @param $name the template name to validate
     * @return bool
     */
    public static function validateTemplateName($name)
    {
        if (empty($name)) {
            return false;
        }
        return preg_match(self::$templateNamePattern, $name);
    }

    /**
     * convert string to byte[]
     * @param $string
     * @return array
     */
    public static function getBytes($string)
    {
        $bytes = array();
        for ($i = 0; $i < strlen($string); $i++) {
            $bytes[] = ord($string[$i]);
        }
        return $bytes;
    }
}