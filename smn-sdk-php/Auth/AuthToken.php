<?php
namespace SMN\Auth;
/**
 * Clean, simple class for Auth Token.
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
 * 认证Token类定义
 * 保存从IAM获取的X-Subject-Token的值，每次访问都要更新有效时间。
 * @author sunzhixi
 */
class AuthToken
{
    private $dateTimeFormat = 'Y-m-d\TH:i:s.u\Z';
    private $refreshDate;
    private $expiredDate;
    private $secretToken;
    private $token;
    private $projectId;
    
    public function __construct($secretToken,$token)
    {
        $this->secretToken = $secretToken;
        $this->token = $token;
        if(isset($token->token))
        {
			$this->refreshDate = $token->token->issued_at;
            $this->setExpiredDate($token->token->expires_at);
            $this->setProjectId($token->token->project->id);
        }
    }
    
    public function isExpired()
    {
        if (is_null($this->expiredDate))
        {
            return false;
        }
        $expires_at = \DateTime::CreateFromFormat($this->dateTimeFormat,$this->expiredDate);
        $now = new \DateTime();
        if ($expires_at>$now) 
        {
            return false;
        }
        return true;
    }
    
    public function getRefreshDate()
    {
        return $this->refreshDate;
    }
    
    public function getExpiredDate()
    {
        return $this->expiredDate;
    }
    
    public function setExpiredDate($expires_at)
    {
        $this->expiredDate = $expires_at;
    }
    
    public function getSecretToken()
    {
        return $this->secretToken;
    }
    
    public function setSecretToken($secretToken)
    {
        $this->secretToken = $secretToken;
    }
    public function getToken()
    {
        return $this->token;
    }
    
    public function setToken($token)
    {
        $this->token = $token;
    }
    public function getProjectId()
    {
        return $this->projectId;
    }
    
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }
} 
?>
