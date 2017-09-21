<?php

function autoloader($path)
{
    $prepare = explode('\\', $path);
    $class = end($prepare);
    
    if(strpos($class, 'Model'))
    {
        include 'Models' . DS . $class . '.php';
        return;
    }
    
    include 'class.' . $class . '.php';
}

spl_autoload_register('autoloader');