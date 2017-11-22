<?php
namespace SMN\Common;
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
 */
class Config
{    
    //public static $authUri="https://10.154.69.13:31943/v3/auth/tokens";
    //public static $authBaseUrl="https://iam.%s.myhwclouds.com/v3/auth/tokens";
    public static $version = "smn-sdk-php/1.0.0";
    public static $authUrl = "https://iam.{regionId}.myhwclouds.com/v3/auth/tokens";
    public static $authJson='{"auth":{"identity":{"methods":["password"],"password":{"user":{"name":"{userName}","domain":{"name":"{domainName}"},"password":"{password}"}}},"scope":{"project":{"name":"{regionId}"}}}}';
    public static $smnBaseUrl="https://smn.{regionId}.myhwclouds.com";
    public static $smsPublishApi="/v2/{projectId}/notifications/sms";

    public static $proxy_host="127.0.0.1";
    public static $proxy_port=8080;
}
?>
