<?php
namespace Test;

require_once dirname(__DIR__) . DS . 'classes' . DS . 'autoloader.php';

class Ftp extends Api
{
    public function __construct($params)
    {
	parent::__construct($params);
    }
	
    public function create($user,$pass,$quota)
    {
        $ftp = new CreateFtpModel($this->user);
        $ftp->setUser($user)
            ->setPass($pass)
            ->setQuota($quota);
        $data = json_decode(json_encode($ftp));
        $restURL = $this->buildUrl('cpanel',$data);
        $this->setUrl($restURL)->execute();   
    }
	
    public function delete($user)
    {
        $ftp = new DeleteFtpModel($this->user);
        $ftp->setUser($user)
            ->setDestroy(1);
        $data = json_decode(json_encode($ftp));
        $restURL = $this->buildUrl('cpanel',$data);
        $this->setUrl($restURL)->execute(); 
    }
        
    public function listAccounts()
    {  
        $ftp = new ListFtpModel($this->user);
        $data = json_decode(json_encode($ftp));
        $restURL = $this->buildUrl('cpanel',$data);
        $result = $this->setUrl($restURL)->execute(); 
        return $result;
    }
        
    public function changeQuota($user,$quota)
    {
        $ftp = new UpdateFtpModel($this->user);
        $ftp->setUser($user)
            ->setQuota($quota);
        $data = json_decode(json_encode($ftp));
        $restURL = $this->buildUrl('cpanel',$data);
        $this->setUrl($restURL)->execute();
    }
    
}