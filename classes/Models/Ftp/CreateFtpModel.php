<?php
require_once dirname(__DIR__) . '/Model.php';

class CreateFtpModel extends Model{
    
    protected $user;
    protected $pass;
    protected $quota;
    protected $serializable = [
        'user',
        'pass',
        'quota'
    ];
    
    public function setUser($user)
    {
        $this->validUser($user);
        $this->user = $user;
        return $this;
    }

    public function setPass($pass) 
    {
        $this->validPassword($pass);
        $this->pass = $pass;
        return $this;
    }

    public function setQuota($quota) 
    {
        $this->validQuota($quota);
        $this->quota = $quota;
        return $this;
    }

}