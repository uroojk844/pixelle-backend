<?php
    include_once("../../../config.php");
    include("../../../utils.php");

    $password = $data["password"];
    $email = $data["email"];
    if(!$email || $email==''){
         echo json_encode(["error"=>"A required parameter was missing!"]);
         die();
    }
    $query = "UPDATE users set password='$password' where email='$email'";
    if($conn->query($query)){
        echo json_encode(["success"=>"Password updated succesfully"]);
    }
    else{
        echo json_encode(["error"=>"Something went wrong"]);
    }
?>