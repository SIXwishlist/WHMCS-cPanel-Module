<?php

class FtpValidator{

	public function validUser($input)
    {
        if(!strlen($input))
            throw new \Exception ('All inputs are required!');
        $pattern = "/[\/~!@#\$%\^&*()+={}[\]|;:'\<>,.\?]/";
        if(preg_match($pattern, $input))
            throw new \Exception('Only (_) and (-) special characters are allowed!');        
        return trim($input);
    }
    
    public function validPassword($input)
    {
        if(!strlen($input))
            throw new \Exception('All inputs are required!');
        return trim($input);   
    }

    public function validQuota($input)
    {
        if(!is_numeric($input))
            throw new \Exception('Quota has to be a number!');
        return trim($input);
    }

}