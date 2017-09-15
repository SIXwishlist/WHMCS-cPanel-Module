<?php
namespace Test;

require_once 'Model.php';

class DeleteFtpModel extends Model{
    
    protected $user;
    protected $destroy;
    protected $serializable = [
        'cpanel_jsonapi_user',
        'cpanel_jsonapi_module',
        'cpanel_jsonapi_func',
        'user',
        'destroy',
    ];

    public function __construct($username)
    {
        $this->cpanel_jsonapi_user = $username;
        $this->cpanel_jsonapi_module = 'Ftp';
        $this->cpanel_jsonapi_func = 'delftp';
    }
    
    public function setUser($user) 
    {
        $this->user = $user;
        return $this;
    }

    public function setDestroy($destroy) 
    {
        $this->destroy = $destroy;
        return $this;
    }

}