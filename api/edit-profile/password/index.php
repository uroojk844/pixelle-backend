<?php
include_once("../../../config.php");
include("../../../utils.php");
include("../../../user_header.php");

$new_password = $data["password"];
$current_password = $data["current"];

$check = "SELECT password FROM users WHERE email='$email'";
$result = $conn->query($check);
$row = $result->fetch_assoc();

if ($row["password"] === $current_password) {
    $query = "UPDATE users SET password='$new_password' WHERE email='$email'";
    if ($conn->query($query)) {
        echo json_encode(["success" => "Password updated successfully"]);
    } else {
        echo json_encode(["error" => "Something went wrong"]);
    }
} else {
    echo json_encode(["error" => "Current password is incorrect"]);
}
?>
