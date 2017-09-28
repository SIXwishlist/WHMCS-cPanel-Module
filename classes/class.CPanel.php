<?php
require_once 'class.Autoloader.php';

class CPanel{
    
    protected $cpanel;
    protected $ftp;

    public function __construct(CPanelAcc $CPanelAcc)
    {
        $this->cpanel = $CPanelAcc;
    }

    public function create($user,$domain)
    {
    	return $this->cpanel->create($user,$domain);                  
    }

    public function suspend($user)
    {
    	return $this->cpanel->suspend($user);   
    }

    public function unsuspend($user)
    {
    	return $this->cpanel->unsuspend($user);  
    }

    public function terminate($user)
    {
    	return $this->cpanel->terminate($user);  
    }

    public function changePassword($user,$pass)
    {
    	return $this->cpanel->changePassword($user,$pass);
    }

    public function testConnection()
    {
    	return $this->cpanel->testConnection();
    }

    public function createFTP(array $params,$user,$pass,$quota)
    {
    	return $this->loadFtpInstance(new CPanelFtp($params))->ftp->create($user,$pass,$quota);
    }

    public function deleteFTP(array $params,$user)
    {
    	return $this->loadFtpInstance(new CPanelFtp($params))->ftp->delete($user);
    }

    public function changeQuotaFTP(array $params,$user,$quota)
    {
    	return $this->loadFtpInstance(new CPanelFtp($params))->ftp->changeQuota($user,$quota);
    }

    public function listAccountsFTP(array $params)
    {
    	return $this->loadFtpInstance(new CPanelFtp($params))->ftp->listAccounts();
    }

    public function loadFtpInstance(CPanelFtp $CPanelFtp)
    {
        $this->ftp = $CPanelFtp;
        return $this;
    }

}