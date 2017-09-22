<?php
require_once 'class.CPanelConnection.php';
require_once 'class.Autoloader.php';

class CPanelFtp extends CPanelConnection{
/**
*** API's = ( 'WHM1', 'API1', 'API2', 'UAPI');
**/
    protected $cpanelModule = 'Ftp';
    protected $cpanelFunc;
    protected $cpanelUser;
    
	public function __construct($params)
    {
        parent::__construct($params);
        $this->cpanelUser = $params['username'];
    }
    public function create($user,$pass,$quota)
    {
        $ftp = new CreateFtpModel();
        $ftp->setUser($user)
            ->setPass($pass)
            ->setQuota($quota);
        $this->data = $this->toArray($ftp);
        $this->cpanelFunc = 'addftp';
        return $this->requestAPI('API2');
    }
	
    public function delete($user)
    {
        $ftp = new DeleteFtpModel();
        $ftp->setUser($user)
            ->setDestroy(1);
        $this->data = $this->toArray($ftp);
        $this->cpanelFunc = 'delftp';
        return $this->requestAPI('API2');
    }
        
    public function listAccounts()
    {  
        $ftp = new ListFtpModel();
        $this->data =  $this->toArray($ftp);
        $this->cpanelFunc = 'listftpwithdisk';
        return $this->requestAPI('API2');
    }
        
    public function changeQuota($user,$quota)
    {
        $ftp = new UpdateFtpModel();
        $ftp->setUser($user)
            ->setQuota($quota);
        $this->data = $this->toArray($ftp);
        $this->cpanelFunc = 'setquota';
        return $this->requestAPI('API2');
    }
    
}