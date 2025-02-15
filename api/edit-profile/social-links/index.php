<?php
    include_once("../../../config.php");
    include("../../../utils.php");

    $links = $data["links"];
    $email = $data["email"];
    if(!$email || $email==''){
         echo json_encode(["error"=>"A required parameter was missing!"]);
         die();
    }
    $query = "UPDATE users set links='$links' where email='$email'";
    if($conn->query($query)){
        echo json_encode(["success"=>"Links updated succesfully"]);
    }
    else{
        echo json_encode(["error"=>"Something went wrong"]);
    }
?>