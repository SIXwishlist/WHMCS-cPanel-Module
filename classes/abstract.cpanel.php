<?php
namespace Test;

require_once 'abstract.connection.php';

abstract class Cpanel extends Connection {
    
    
    public function create($args)
    {    
        $restURL = $this->buildUrl('createacct',$args);
        $this->setUrl($restURL)->execute();     
    }
    
    public function suspend($args)
    {
        $restURL = $this->buildUrl('suspendacct',$args);
        $this->setUrl($restURL)->execute();
    }
    
     public function unsuspend($args)
    {
        $restURL = $this->buildUrl('unsuspendacct',$args);
        $this->setUrl($restURL)->execute();
    }
    
    public function terminate($args)
    {
        $restURL = $this->buildUrl('removeacct',$args);
        $this->setUrl($restURL)->execute();
    }
	
    public function changePassword($args)
    {
        $restURL = $this->buildUrl('passwd',$args);
        $this->setUrl($restURL)->execute();
    }
	
    public function testConnection($args)
    {
        $restURL = $this->buildUrl('listaccts',$args);
        $this->setUrl($restURL)->execute();
    }
	
    public function loadFtpInstance($params)
    {
        $this->ftp = new Ftp($params);		
    }
    
}