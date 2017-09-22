<?php

class CPanelApi{
    
    protected $apiVersion;
    
    protected function requestAPI($ver,$data = null)
    {
        if(!$ver)
        {
            throw new Exception("You need to select an API!");           
        }
        switch($ver)
        {
            case 'WHM1':
            return $this->requestWHM1();
            break;
            case 'API1':
            break;
            case 'API2':
            return $this->requestAPI2();
            break;
            case 'UAPI':
            return $this->requestUAPI($data);
            break;
            default:
            throw new Exception("Selected API does not exists!");
            break;
        }
    }

    protected function requestWHM1()
    {
    	$this->apiVersion = 1;
        $url = '/json-api/' . $this->buildURL($this->function,$this->data,$this->apiVersion);
        return $this->setUrl($url)->execute();
    }
    
    protected function requestAPI1()
    {
        
    }
    
    protected function requestAPI2($dataNew)
    {
        $this->apiVersion = 2;       
        $this->function = 'cpanel';
        $props = array(
            $this->cpanelUser,
            $this->cpanelModule,
            $this->cpanelFunc,
            $this->apiVersion);
        $args = array_combine($this->queryArray(),$props);
        $args2 = $this->getVars($this->data);
        $this->data = $this->mergeArrays($args,$args2);
        $url = '/json-api/' . $this->buildURL($this->function,$this->data);
        return $this->setUrl($url)->execute();       
    }
    
    protected function requestUAPI($data)
    {
        $this->data = $data;
        $url = '/execute/' . $this->cpanelModule . '/' . $this->buildURL($this->cpanelFunc,$this->data);
        return $this->setUrl($url)->execute();
    }

    protected function queryArray()
    {
        return array(
            'cpanel_jsonapi_user',
            'cpanel_jsonapi_module',
            'cpanel_jsonapi_func',
            'cpanel_jsonapi_apiversion');

    }
        
}