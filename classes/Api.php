<?php
namespace Test;

require_once 'abstract.cpanel.php';

class Api extends Cpanel
{
    protected $username;
    protected $password;
    protected $user;
    protected $url;
    protected $curl;
    
   public function __construct($params)
   {
    $this->username = $params['serverusername'];
    $this->password = $params['serverpassword'];
    $this->user = $params['username'];
    $this->url = $params['serverhttpprefix'] . "://" . $params['serverip'] . ':2087';
    $this->prepare();
   }
   
   public function prepare()
    {
    $this->curl = curl_init();
    curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER,0);       
    curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST,0);       
    curl_setopt($this->curl, CURLOPT_HEADER,0);               
    curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,1);       
    $header[0] = "Authorization: Basic " . base64_encode($this->username . ":" . $this->password) . "\n\r";
    curl_setopt($this->curl, CURLOPT_HTTPHEADER, $header);
    }

   public function setUrl($action)
   {
       curl_setopt($this->curl, CURLOPT_URL, $this->url . "/json-api/" . $action);
       return $this;
    }
    
    public function buildUrl($url,$data = null)
    {
        if(is_object($data))
            $data = $this->getVars($data);
        return $url . (empty($data) ? '' : '?' . http_build_query($data));
    }
    
    public function getVars($object)
    {
        return get_object_vars($object);
    }
}