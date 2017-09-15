<?php
namespace Test;

require_once 'Model.php';

class ListFtpModel extends Model{
    
    protected $serializable = [
        'cpanel_jsonapi_user',
        'cpanel_jsonapi_module',
        'cpanel_jsonapi_func',
    ];

    public function __construct($username)
    {
        $this->cpanel_jsonapi_user = $username;
        $this->cpanel_jsonapi_module = 'Ftp';
        $this->cpanel_jsonapi_func = 'listftpwithdisk';
    }

}