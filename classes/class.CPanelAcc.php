<?php
require_once 'interface.CPanelAcc.php';
require_once 'class.CPanelConnection.php';
require_once 'class.Autoloader.php';

class CPanelAcc extends CPanelConnection implements CPanelInterface{
    
    protected $data;
    protected $function;


    public function __construct($params)
    {
        parent::__construct($params);
    }

    public function create($user,$domain)
    { 
        $this->data = array(
                'user' => $user, 
                'domain' => $domain
            );
        $this->function = 'createacct';
        $url = $this->requestWHM1();
        die(var_dump($url));
        
        //$restURL = $this->buildUrl('createacct',$data);
        
        //$this->setUrl($restURL)->execute(); 
    }
    public function suspend($user)
    {
        $data = array(
                'user' => $user
            );
        $restURL = $this->buildUrl('suspendacct',$data);
        $this->setUrl($restURL)->execute();
    }
    
     public function unsuspend($user)
    {
        $data = array(
                'user' => $user
            );
        $restURL = $this->buildUrl('unsuspendacct',$data);
        $this->setUrl($restURL)->execute();
    }
    
    public function terminate($user)
    {
        $data = array(
                'user' => $user
            );
        $restURL = $this->buildUrl('removeacct',$data);
        $this->setUrl($restURL)->execute();
    }
	
    public function changePassword($user,$password)
    {
        $data = array(
                'user' => $user,
                'password' => $password
            );
        $restURL = $this->buildUrl('passwd',$data);
        $this->setUrl($restURL)->execute();
    }
	
    public function testConnection()
    {
        $restURL = $this->buildUrl('listaccts');
        $this->setUrl($restURL)->execute();
    }
    
}