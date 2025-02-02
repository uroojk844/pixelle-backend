<?php
$method = 'POST';
include_once("../../config.php");

if(isset($_COOKIE['user'])){
    $user = explode("|",$_COOKIE['user']);
    $email = $user[0];
    $id = $user[1];
    
    $sql = "SELECT * FROM users where email='$email' and id=$id";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res)) {
        $row = mysqli_fetch_assoc($res);
        unset($row['password']);
        echo json_encode(['success'=>$row]);
    }else{
        echo json_encode(['error'=>'Unauthorize']);
    }
}
?>