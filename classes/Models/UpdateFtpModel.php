<?php

require_once 'Model.php';

class UpdateFtpModel extends Model{
    
    protected $user;
    protected $quota;
    protected $serializable = [
        'cpanel_jsonapi_user',
        'cpanel_jsonapi_module',
        'cpanel_jsonapi_func',
        'user',
        'quota'
    ];
    
    public function __construct($username)
    {
        $this->cpanel_jsonapi_user = $username;
        $this->cpanel_jsonapi_module = 'Ftp';
        $this->cpanel_jsonapi_func = 'setquota';
    }
    
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