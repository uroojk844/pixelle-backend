<?php
$method = 'POST';
include_once("../../config.php");
    if(!isset($data['username']) || !isset($data['email']) || !isset($data['password']) ){  
        print_r(json_encode(["error"=>"A required parameter was missing!"]));
    }
    else{
       print_r($data);
    }
?>