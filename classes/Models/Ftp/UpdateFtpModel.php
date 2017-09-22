<?php

require_once dirname(__DIR__) . '/Model.php';

class UpdateFtpModel extends Model{
    
    protected $user;
    protected $quota;
    protected $serializable = [
        'user',
        'quota'
    ];
    
    public function setUser($user) 
    {
        $this->user = $user;
        return $this;
    }

    public function setQuota($quota) 
    {
        $this->quota = $quota;
        return $this;
    }
    
}