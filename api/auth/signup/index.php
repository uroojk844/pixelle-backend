<?php
    include_once("../../../config.php");
    include("../../../utils.php");

    $fields = array("fullname","email","password");
    
    if(validateInput($data,$fields)){
        $email = $data['email'];
        $password = $data['password'];
        $fullname = $data['fullname'];
        
        //checking is account exists already
        $checkExists = "SELECT * FROM users where email='$email'";
        $result = $conn->query($checkExists);
        $rowCount = mysqli_num_rows($result);

        if($rowCount>0) echo json_encode(["error"=>"This email is already in use!"]);
        else{
            //generating username
            $username =  str_replace(" ","",$fullname).rand(100,999);
            $insertQuery = "INSERT INTO users(fullname,username,email,password) values ('$fullname','$username','$email','$password')";
            //save user
            if($conn->query($insertQuery)) echo json_encode(["success"=>"Account created!"]);
            else echo json_encode(["error"=>"Something went wrong!"]);
        }
        
    }
    else{
        echo json_encode(["error"=>"A required field is missing"]);
    }
?>