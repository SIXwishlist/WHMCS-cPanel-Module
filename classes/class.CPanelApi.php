<?php

class CPanelApi{
    
    protected $apiVersion;
    protected $outPutFormat = '/json-api/';


    protected function requestAPI($ver)
    {
        if(!$ver)
        {
            throw new Exception("You need to select an API!");           
        }
        switch($ver)
        {
            case 'WHM1':
                return $this->requestWHM1();
            case 'API1':
                return $this->requestAPI1();
            case 'API2':
                return $this->requestAPI2();
            case 'UAPI':
                return $this->requestUAPI();
            default:
                throw new Exception("Selected API does not exists!");
        }
    }

    protected function requestWHM1()
    {
    	$this->apiVersion = 1;
        $url = $this->outPutFormat . $this->buildURL($this->function,$this->data,$this->apiVersion);
        return $this->setUrl($url)->execute();
    }
    
    protected function requestAPI1()
    {
        $this->apiVersion = 1;       
        $this->function = 'cpanel';
        $props = array(
            $this->cpanelUser,
            $this->cpanelModule,
            $this->cpanelFunc,
            $this->apiVersion);
        $args = array_combine($this->queryArray(),$props);
        $args2 = $this->getVars($this->data);
        $this->data = $this->mergeArrays($args,$args2);
        $url = $this->outPutFormat . $this->buildURL($this->function,$this->data,$this->apiVersion);
        return $this->setUrl($url)->execute();         
    }
    
    protected function requestAPI2()
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
        $url = $this->outPutFormat . $this->buildURL($this->function,$this->data,$this->apiVersion);
        return $this->setUrl($url)->execute();       
    }
    
    protected function requestUAPI()
    {
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