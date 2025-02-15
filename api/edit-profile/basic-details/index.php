<?php
    include_once("../../../config.php");
    include("../../../utils.php");

    $name = $data["name"];
    $bio = $data["bio"];
    $city = $data["city"];
    $state = $data["state"];
    $email = $data["email"];
    if(!$email || $email==''){
         echo json_encode(["error"=>"A required parameter was missing!"]);
         die();
    }
    $query = "UPDATE users set name='$name',bio='$bio', city='$city', state='$state' where email = '$email'";
    if($conn->query($query)){
        echo json_encode(["success"=>"Profile updated succesfully"]);
    }
    else{
        echo json_encode(["error"=>"Something went wrong"]);
    }
?>