<?php
$jsonData = file_get_contents('php://input');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $data = json_decode($jsonData, true);
}else{
    echo "Invalid request method";
    die();
}
?>