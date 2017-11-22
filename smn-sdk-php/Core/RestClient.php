<?php
namespace SMN\Core;
use Http\HttpHelper   as HttpHelper;
use SMN\Common\Config as Config;
use SMN\Core\Response as Response;
/**
 * Clean, simple static class for HTTP REST Client.
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
 * HTTP REST Client定义
 * @member string  $proxy_auth_type   代理类型 
 * @member string  $auth_username     用户名
 * @member string  $auth_password     密码
 *
 * @author sunzhixi
 */
class RestClient
{
    private static $proxy_auth_type;
    private static $auth_username;
    private static $auth_password;
    private static $proxy_type;
    private static $proxy_host;
    private static $proxy_port;
    public static function setProxy_host($proxy_host)
    {
        self::$proxy_host = $proxy_host;
    }
    public static function setProxy_port($proxy_port)
    {
        self::$proxy_port = $proxy_port;
    }
    public static function getResponse($request)
    {
        $httpHelper = HttpHelper::init()->uri($request->uri)->method(strtoupper($request->method))->addHeaders($request->headers)->body($request->body,$request->content_type)->expects($request->expected_type)->withoutStrictSSL();
        if(!is_null(Config::$proxy_host) && !is_null(Config::$proxy_port))
        {
            $httpHelper = $httpHelper->useProxy(Config::$proxy_host,Config::$proxy_port);
        }
        if(!is_null(self::$proxy_host) && !is_null(self::$proxy_port))
        {
            $httpHelper = $httpHelper->useProxy(self::$proxy_host,self::$proxy_port);
        }
        $response = $httpHelper->send();
        return new Response($request,$response);
    }
}    
?>
