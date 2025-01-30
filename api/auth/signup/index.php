<?php
    include_once("../../../config.php");
    include("../../../utils.php");

    $fields = array("username","email","password");
    if(validateInput($data,$fields)){
        print("Works");
    }
    else{
        echo json_encode(["error"=>"A required field is missind"]);
    }
?>