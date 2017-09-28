<?php

function autoloader($path)
{
    $prepare = explode('\\', $path);
    $class = end($prepare);
    
    if(strpos($class, 'Model'))
    {
    	if(strpos($class,'CPanel'))
    	{
    		include 'Models' . DS . 'CPanel' . DS . $class . '.php';
    	}
    	if(strpos($class,'Ftp'))
    	{
    		include 'Models' . DS . 'Ftp' . DS . $class . '.php';
    	}
    	else
    	{
            include 'Models' . DS . $class . '.php';
   	}
   		
        return;
    }
    
    include 'class.' . $class . '.php';
}

spl_autoload_register('autoloader');