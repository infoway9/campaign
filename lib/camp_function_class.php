<?php
class Campaign_Func_Class {
    
    function validEmail($email)
    {
        $pattern = '/^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/';
        return preg_match($pattern, $email);
    }
    
   
}
?>