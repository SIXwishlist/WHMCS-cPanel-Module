<?php

require_once dirname(__DIR__) . '/Model.php';

class DeleteFtpModel extends Model{
    
    protected $user;
    protected $destroy;
    protected $serializable = [
        'user',
        'destroy',
    ];

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