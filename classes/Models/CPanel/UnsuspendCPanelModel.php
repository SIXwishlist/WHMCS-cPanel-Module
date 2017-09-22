<?php
require_once dirname(__DIR__) . '/Model.php';

class UsuspendCPanelModel extends Model{
    
    protected $user;
    protected $domain;
    protected $serializable = [
        'user'
    ];
    
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}