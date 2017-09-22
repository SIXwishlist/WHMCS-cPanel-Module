<?php
require_once dirname(__DIR__) . '/Model.php';

class PasswordCPanelModel extends Model{
    
    protected $user;
    protected $domain;
    protected $serializable = [
        'user',
        'password'
    ];
    
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}