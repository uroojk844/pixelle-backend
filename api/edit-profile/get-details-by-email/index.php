<?php
    include_once("../../../config.php");
    include("../../../utils.php");
    $feilds = array("email");

    if(validateInput($data,$feilds)){
        $email = $data['email'];
        $getData = "SELECT * from users where email = '$email'";
        $result = $conn->query($getData);
        $row = mysqli_fetch_assoc($result);
        print_r(json_encode($row));
    }
    else{
        echo json_encode(["error"=>"All feilds are required!"]);
        die();
    }
?>