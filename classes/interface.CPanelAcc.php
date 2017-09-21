<?php

interface CPanelInterface{

    public function create($user,$domain);
    public function suspend($user);
    public function unsuspend($user);
    public function terminate($user);
    public function changePassword($user,$password);
    public function testConnection();   
    
}