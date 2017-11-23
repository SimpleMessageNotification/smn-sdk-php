<?php 
namespace SMN\Request;
use SMN\Core\AbstractRequest as AbstractRequest;
use SMN\Common\Config        as Config;
use SMN\Exception\SMNException as SMNException;

/**
 * simple class for SMN SmsPublish request.
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
 * SMN短信发送类定义
 *
 * @author sunzhixi
 */
class SmsPublishRequest extends AbstractRequest
{
    private $endpoint;
    private $message;
    private $signId;
    private $patternTelphone = '/^\+?[0-9]{1,31}$/';
    public function __construct($account)
    {
        parent::__construct("SmsPublish",$account);
        $url=Config::$smnBaseUrl . Config::$smsPublishApi;
        $this->setUrl($url);
        $this->setMethod("POST");
        $this->setContent_type("json");
        $this->setExpected_type("json");
    }
    public function getEndpoint()
    {    
        return $this->endpoint;
    }
    public function setEndpoint($endpoint)
    {    
        $this->endpoint=$endpoint;
    }
    public function getMessage()
    {    
        return $this->message;
    }
    public function setMessage($message)
    {    
        $this->message=$message;
    }
    public function getSignId()
    {    
        return $this->signId;
    }
    public function setSignId($signId)
    {    
        $this->signId=$signId;
    }
    private function validateSignId()
    {
        if(empty($this->signId))
        {
            throw new SMNException("SDK.SmsPublishRequestException","SmsPublishRequestException : empty signId!");
        }
    }
    private function validateMessage()
    {
        if(is_null($this->message))
        {
            throw new SMNException("SDK.SmsPublishRequestException","SmsPublishRequestException : No Message!");
        }
    }
    private function validateEndpoint()
    {
        if(is_null($this->endpoint))
        {
            throw new SMNException("SDK.SmsPublishRequestException","SmsPublishRequestException : No endpoint!");
        }
        if(!preg_match($this->patternTelphone,$this->endpoint))
        {
            throw new SMNException("SDK.SmsPublishRequestException","SmsPublishRequestException : Wrong phone number format, correct format is +8600000000000 or 00000000000!");
        }
    }
    public function buildRequest()
    {
        $this->validateEndpoint();
        $this->validateSignId();
        $this->validateMessage();
        $url=str_replace(array('{regionId}','{projectId}'),array($this->account->getRegionId(),$this->account->getAuthToken()->getProjectId()),$this->getUrl());
        $this->setUrl($url);
        $request = new \stdclass();
        $request->uri     =$this->getUrl();
        $request->method  =$this->getMethod();
        $request->headers =$this->getHeaders();
        $request->body    =$this->getBody();
        $request->headers['X-Auth-Token'] = $this->account->getAuthToken()->getSecretToken();
        $request->body['endpoint']        = $this->endpoint;
        $request->body['message']         = $this->message;
        $request->body['signId']          = $this->signId;
        $request->content_type            = $this->getContent_type();
        $request->expected_type           = $this->getExpected_type();
        return $request;
    }
}
?>
