<?php

require_once 'Model.php';

class CreateFtpModel extends Model{
    
    protected $user;
    protected $pass;
    protected $quota;
    protected $serializable = [
        'cpanel_jsonapi_user',
        'cpanel_jsonapi_module',
        'cpanel_jsonapi_func',
        'user',
        'pass',
        'quota'
    ];

    public function __construct($username)
    {
        $this->cpanel_jsonapi_user = $username;
        $this->cpanel_jsonapi_module = 'Ftp';
        $this->cpanel_jsonapi_func = 'addftp';
    }
    
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