<?php
$method = 'POST';
include_once("../../config.php");
$headers = apache_request_headers();

if(isset($headers['Authorization'])){
    $user = explode("|",$headers['Authorization']);
    $email = $user[0];
    $id = $user[1];
    
    $sql = "SELECT * FROM users where email='$email' and id='$id'";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res)) {
        $row = mysqli_fetch_assoc($res);
        unset($row['password']);
        echo json_encode(['success'=>$row]);
    }else{
        echo json_encode(['error'=>'Unauthorize']);
    }
}else{
    echo json_encode(['error'=>'Unauthorize']);
}
?>