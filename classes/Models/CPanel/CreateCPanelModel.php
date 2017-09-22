<?php
require_once dirname(__DIR__) . '/Model.php';

class CreateCPanelModel extends Model{
    
    protected $user;
    protected $domain;
    protected $serializable = [
        'user',
        'domain'
    ];
    
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function setDomain($domain) 
    {
        $this->domain = $domain;
        return $this;
    }
}