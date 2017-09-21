<?php

class CPanelApi{
    
    protected $apiVersion = array(
        'API1' , 'API2' , 'UAPI'
    );
    protected $user;
    protected $module;
    protected $func;
    
    protected function requestWHM1()
    {
        die(var_dump($this->buildUrl($this->data)));
        return '/json-api/' . $this->function . '?api.version=1'. $this->buildUrl($this->data);    
    }
    
    protected function requestAPI1()
    {
        
    }
    
    protected function requestAPI2()
    {
        list($api,$user,$module,$function) = $this->queryArray();
    }
    
    protected function requestUAPI()
    {
        
    }

    private function queryArray()
    {
        return array(
                'json-api', 'cpanel_jsonapi_user', 'cpanel_jsonapi_module',
                    'cpanel_jsonapi_func',
                    'cpanel_jsonapi_apiversion');

    }
    
    public function buildURL(array $data)
    {
        if(is_object($data))
        {
            $data = $this->getVars($data);
        }
        
        return (empty($data) ? '' : '?' . http_build_query($data));
    }
    
}