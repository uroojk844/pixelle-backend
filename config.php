<?php
    $jsonData = file_get_contents('php://input');
    
    $method = isset($method) ? $method : 'GET';
    if ($_SERVER['REQUEST_METHOD'] === $method) {
    $data = json_decode($jsonData, true);
    }else{
        echo "Invalid request method";
        die();
    }
?>