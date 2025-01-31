<?php

//database connection
$conn = mysqli_connect("localhost","root","","pixelle");
if(!$conn){
    print_r("Cannot connect to database");
    die();
}

//reading user input
$jsonData = file_get_contents('php://input');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $data = json_decode($jsonData, true);
}else{
    echo "Invalid request method";
    die();
}
?>