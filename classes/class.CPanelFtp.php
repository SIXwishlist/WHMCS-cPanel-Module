<?php
require_once 'class.CPanelConnection.php';
require_once 'class.Autoloader.php';

class CPanelFtp extends CPanelConnection{
    
	public function __construct($params)
    {
        parent::__construct($params);
    }
    public function create($cpanelUser,$user,$pass,$quota)
    {
        $ftp = new CreateFtpModel($cpanelUser);
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
        
    public function listAccounts($user)
    {  
        $ftp = new ListFtpModel($user);
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