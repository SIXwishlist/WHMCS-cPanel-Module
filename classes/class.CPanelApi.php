<?php
require_once 'class.CpanelBase.php';

class CPanelApi extends CPanelBase{
    
    protected $apiVersion = array(
        'API1' , 'API2' , 'UAPI'
    );
    protected $user;
    protected $module;
    protected $function;
    
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
    
    
}