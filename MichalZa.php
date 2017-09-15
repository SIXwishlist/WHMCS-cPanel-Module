<?php
define('DS', DIRECTORY_SEPARATOR);

require_once dirname(__FILE__) . DS . 'classes' . DS . 'autoloader.php';

use WHMCS\Database\Capsule as DB;


if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function MichalZa_MetaData()
{
    return array('DisplayName' => 'MichalZa');
}  

function MichalZa_ConfigOptions()
{
    Table::create();
}

function MichalZa_CreateAccount(array $params)
{
if(!$params['domain'])
    throw new \Exception('You need to fill domain input first!');  

$args = array(
		'api.version' => 1,
		'user'        => $params['username'],
		'domain'	  => $params['domain']
			);
try
{ 
   $a = new \Test\Api($params);
   $a->create($args);
}
catch(Exception $e)
{
	return $e->getMessage();
}

return 'success';
}

function MichalZa_SuspendAccount(array $params)
{  
    try
    {  
        $args = array(
		'api.version' => 1,
		'user'        => $params['username']
		);
   
        $a = new \Test\Api($params);
        $a->suspend($args);
    }
    catch(Exception $e)
    {
	return $e->getMessage();
    }
    return 'success';

}

function MichalZa_UnsuspendAccount(array $params)
{
    try
    {	
        $args = array(
		'api.version' => 1,
		'user'        => $params['username']
		);
   
        $a = new \Test\Api($params);
        $a->unsuspend($args);
    }
    catch(Exception $e)
    {
	return $e->getMessage();
    }
    return 'success';
}

function MichalZa_TerminateAccount(array $params)
{
    try
    {
        $args = array(
		'api.version' => 1,
		'user'        => $params['username']
		);
   
        $a = new \Test\Api($params);
        $a->terminate($args);
   
    }
    catch(Exception $e)
    {
	return $e->getMessage();
    }
    return 'success';
}

function MichalZa_ChangePassword(array $params)
{
    try 
    {
    	$args = array(
		'api.version' => 1,
		'user'        => $params['username'],
		'password'    => $params['password']
		);
	$a = new \Test\Api($params);
	$a->changePassword($args);
    }
    catch (Exception $e)
    {      
        return $e->getMessage();
    }
    return 'success';
}

function MichalZa_TestConnection(array $params)
{
    try
    {	
    	$a = new \Test\Api($params);
		$a->testConnection($args); 
    }
    catch(Exception $e)
    {
		return array('error' => $e->getMessage());
    }
		return array('success' => true);  
}

function MichalZa_AdminServicesTabFields($params) 
{

    $result = DB::table('customtable')->select('var1','var2','var3','var4')->where('serviceid' , $params['serviceid'])->first();
	
    $var1 = $result->var1;
    $var2 = $result->var2;
    $var3 = $result->var3;
    $var4 = $result->var4;

    $fieldsarray = array(
                            'Field 1' => '<input type="text" name="modulefields[0]" size="30" value="'.$var1.'" />',
                            'Field 2' => '<select name="modulefields[1]" value='.$var2.'><option value="Val1">Val1</option><option value="Val2">Val2</option></select>',
                            'Field 3' => '<textarea name="modulefields[2]" rows="2" cols="80">'.$var3.'</textarea>',
                            'Field 4' => $var4,
                        );
    return $fieldsarray;

}

function MichalZa_AdminServicesTabFieldsSave($params) 
{
		
    $result = DB::table('customtable')->select('var1','var2','var3','var4')->where('serviceid' , $params['serviceid'])->first();
    if(!$result)
    {	
        $new = array(
                        'serviceid'=>$params['serviceid'],
                        'var1'=>$_POST['modulefields'][0],
                        'var2'=>$_POST['modulefields'][1],
                        'var3'=>$_POST['modulefields'][2],
                        'var4'=>'Readonly'
                    );
						
	DB::table('customtable')->insert($new);	
	}
	else 
	{
            $data = array(
                            "var1"=>$_POST['modulefields'][0],
                            "var2"=>$_POST['modulefields'][1],
                            "var3"=>$_POST['modulefields'][2]
			);
		
            DB::table('customtable')->where('serviceid' , $params['serviceid'])->update($data);	
	}
}

function MichalZa_ClientAreaCustomButtonArray() 
{	
    return array("Manage FTP" => "ftp");
}

function MichalZa_ClientArea($params)
{
    add_hook('ClientAreaPrimarySidebar', 1, function (WHMCS\View\Menu\Item $primarySidebar) use( $params) {

        $panel = $primarySidebar->getChild('Service Details Overview');
        if (is_a($panel, 'WHMCS\View\Menu\Item')) {
            $panel = $panel->getChild('Information');
            if (is_a($panel, 'WHMCS\View\Menu\Item')) {
                $panel->setUri("clientarea.php?action=productdetails&id={$params['serviceid']}");
                $panel->setAttributes(array());
            }
        }
    });

    
    if($_GET['method'] == 'delete')
    {
        try
	{
            $api = new \Test\Api($params);
            $api->loadFtpInstance($params);
            $api->ftp->delete($_GET['user']);
            return 'success';
        }
        catch (Exception $e) 
        {
            echo json_encode(array('error' => $e->getMessage()));
            die();
        }

    }
    if($_GET['method'] == 'create')
    {
	try
	{
            $a = new \Test\Api($params);
            $a->loadFtpInstance($params);
            $a->ftp->create($_POST['user'],$_POST['pass'],$_POST['quota']);
            echo json_encode(array('msg' => 'success'));
            die();
        }
	catch (Exception $e)
        {
            echo json_encode(array('error' => $e->getMessage()));
            die();
	}
    }
    if($_GET['method'] == 'update')
    {
        try
        {
            $a = new \Test\Api($params);
            $a->loadFtpInstance($params);
            $a->ftp->changeQuota($_GET['user'] , $_GET['quota']);
            echo json_encode(array('msg' => 'success'));
            die();
        }
        catch (Exception $e)
        {
           // echo json_encode(array('error' => $e->getMessage()));
            echo json_encode(array('msg' => 'success'));
            die();
        }
    }
    
    if($_GET['method'] == 'list')
    {
        try
        {
            $a = new \Test\Api($params);
            $a->loadFtpInstance($params);
            $result = $a->ftp->listAccounts();
            $data = $result->cpanelresult->data;
            echo json_encode($data);
            die();
        }
        catch (Exception $e)
        {
            echo json_encode(array('error' => $e->getMessage()));
            die();
        }
    }
}

function MichalZa_ftp($params)
{  
    
    return array(   'templatefile' => 'templates/ManageFtp',
                    'vars' => array(
                    'serviceid' => $params['serviceid'],
                    'cusername' => $params['username']));
}

