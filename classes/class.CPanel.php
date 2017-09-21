<?php
require_once 'class.Autoloader.php';

class CPanel  {
    
    protected $cpanel;
	protected $ftp;
	protected $api;

	public function __construct(array $params)
	{
		$this->cpanel = new CPanelAcc($params);
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
    	$this->loadFtpInstance($params);
    	return $this->ftp->create($params['username'],$user,$pass,$quota);
    }

    public function deleteFTP(array $params,$user)
    {
    	$this->loadFtpInstance($params);
    	return $this->ftp->delete($user);
    }

    public function changeQuotaFTP(array $params,$user,$quota)
    {
    	$this->loadFtpInstance($params);
    	return $this->ftp->changeQuota($user,$quota);
    }

    public function listAccountsFTP($params)
    {
    	$this->loadFtpInstance($params);
    	return $this->ftp->listAccounts($params['username']);
    }

    public function loadFtpInstance($params)
    {
        $this->ftp = new CPanelFtp($params);
	}

}