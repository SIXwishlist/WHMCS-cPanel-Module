<?php
require_once 'interface.CPanelAcc.php';
require_once 'class.CPanelConnection.php';
require_once 'class.Autoloader.php';

class CPanelAcc extends CPanelConnection implements CPanelInterface{   
/**
*** API's = ( 'WHM1', 'API1', 'API2', 'UAPI');
**/   
    protected $data;
    protected $function;


    public function __construct($params)
    {
        parent::__construct($params);
    }

    public function create($user,$domain)
    {
    	$create = new CreateCPanelModel();
    	$create->setUser($user)
    		->setDomain($domain);
    	$this->data = $this->toArray($create);	  
        $this->function = 'createacct';
        return $this->requestAPI('WHM1');
    }
    public function suspend($user)
    {
    	$suspend = new SuspendCPanelModel();
    	$suspend->setUser($user);
    	$this->data = $this->toArray($suspend);	
        $this->function = 'suspendacct';
        return $this->requestWHM1();
    }
    
     public function unsuspend($user)
    {
    	$unsuspend = new UnsuspendCPanelModel();
    	$unsuspend->setUser($user);
    	$this->data = $this->toArray($unsuspend);
        $this->function = 'unsuspendacct';
        return $this->requestWHM1();
    }
    
    public function terminate($user)
    {
    	$terminate = new TerminateCPanelModel();
    	$terminate->setUser($user);
    	$this->data = $this->toArray($terminate);
        $this->function = 'removeacct';
        return $this->requestWHM1();
    }
	
    public function changePassword($user,$password)
    {
    	$change = new PasswordCPanelModel();
    	$change->setUser($user)
    		   ->setPassword($password);
    	$this->data = $this->toArray($change);
        $this->function = 'passwd';
        return $this->requestWHM1();
    }
	
    public function testConnection()
    {
        $this->function = 'listaccts';
        return $this->requestWHM1();
    }
    
}