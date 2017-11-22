<?php
namespace SMN\Core;
use SMN\Common\Config  as Config;
/**
 * Abstract class for SMN request.
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
 * 抽象请求类定义
 * @member string $actionName    请求类的行为描述，例如，发送短信:"smsPublish"
 * @member CloudAccount $account 租户对象
 * @member string $url    请求Url
 * @member array $params  查询参数（Url里面的参数）
 * @member string $method 请求Method
 * @member array $body    请求Body体
 * @member array $headers 自定义请求头
 * @member string $content_type    请求body类型，取值可以为：json、html、form、text等
 * @member string $expected_type   期望响应body类型，取值可以为：json、html、form、text等
 * @member function buildRequest() 构建要发送的请求对象，子类必须实现
 *
 * @author sunzhixi
 */
abstract class AbstractRequest
{
    protected   $actionName;
    protected   $account;
    protected   $url;
    protected   $params=array();
    protected   $method;
    protected   $body=array();
    protected   $headers=array();
    protected   $content_type;
    protected   $expected_type;
    function __construct($actionName,$account)
    {    
        $this->actionName=$actionName;
        $this->account=$account;
        $this->headers['User-Agent'] = Config::$version;
    }
    public function getActionName()
    {    
        return $this->actionName;
    }
    public function setActionName($actionName)
    {    
        $this->actionName=$actionName;
    }
    public function getAccount()
    {    
        return $this->account;
    }
    public function setAccount($account)
    {    
        $this->account=$account;
    }
    public function getUrl()
    {    
        return $this->url;
    }
    public function setUrl($url)
    {    
        $this->url=$url;
    }
    public function getParams()
    {    
        return $this->params;
    }
    public function setParams($params)
    {    
        $this->params=$params;
    }
    public function getBody()
    {    
        return $this->body;
    }
    public function setBody($body)
    {    
        $this->body=$body;
    }
    public function getMethod()
    {    
        return $this->method;
    }
    public function setMethod($method)
    {    
        $this->method=$method;
    }
    public function getHeaders()
    {    
        return $this->headers;
    }
    public function setHeaders($headers)
    {    
        $this->headers=$headers;
    }
    public function getContent_type()
    {    
        return $this->content_type;
    }
    public function setContent_type($content_type)
    {    
        $this->content_type=$content_type;
    }
    public function getExpected_type()
    {    
        return $this->expected_type;
    }
    public function setExpected_type($expected_type)
    {    
        $this->expected_type=$expected_type;
    }
    public abstract function buildRequest();
}
?>
