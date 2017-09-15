<?php
namespace Test;

abstract class Connection{

    
    public function parse($result)
    {
        $response = json_decode($result);
        if(self::checkJson($result))
        {
          throw new \Exception('Contact admin immediately!');         
        }
        self::checkCpanelError($response);
		return $response;
    }
   
   public function execute()
   {
       $response = curl_exec($this->curl);
       if(curl_errno($this->curl))
       {
           throw new \Exception(curl_error($this->curl));
		}
       return $this->parse($response);
   }
   
   public static function checkJson($json)
   {
       return json_last_error(json_decode($json));
   }

   public static function checkCpanelError($response)
   {
   	    if(isset($response->metadata->result) && $response->metadata->result == 0)
        {	
            throw new \Exception($response->metadata->reason);	  
        }
        if($response->cpanelresult->error && $response->cpanelresult->data->result == 0)
		{
            throw new \Exception($response->cpanelresult->error);
		}
        if(isset($response->cpanelresult->error) && $response->cpanelresult->result == 0)
        { 	
          throw new \Exception($response->cpanelresult->data->reason);
        }
        return $response;
   }
    
}