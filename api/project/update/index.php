<?php
include_once("../../../config.php");

$headers = apache_request_headers();

if (isset($_POST['name']) && isset($_FILES['files']) && isset($headers['Authorization'])) {
    $user = explode("|", $headers['Authorization']);
    $userid = $user[1];
    $title = $_POST['name'];
    $tags = $_POST['tags'];

    // uploading files
    $dir = "../../../ui";

    $projectID = $_POST['id'];
    $visibility = $_POST['visibility'];

    $filepath = "$dir/$projectID";

    $files = array();

    $uploaded = false;

    $filepath = "$dir/$projectID";
    if (is_array($_FILES['files']['name'])) {
        for ($file = 0; $file < count($_FILES['files']['name']); $file++) {
            $name = $_FILES['files']['name'][$file];
            if (str_ends_with($name, 'htm') || str_ends_with($name, 'html')) {
                $name = 'index.html';
            }
            $files[] = $name;
            $temp_name = $_FILES['files']['tmp_name'][$file];
            if (move_uploaded_file($temp_name, "$filepath/$name")) {
                $uploaded = true;
            } else $uploaded = false;
        }
    } else {
        $name = $_FILES['files']['name'];
        $files[] = $name;
        $temp_name = $_FILES['files']['tmp_name'];
        if (move_uploaded_file($temp_name, "$filepath/$name")) {
            $uploaded = true;
        } else $uploaded = false;
    }

    if ($uploaded) {
        $files = implode(",", $files);
        $query = "UPDATE `projects` set `files`='$files',`name`='$title',`tags`='$tags',`visibility`='$visibility' where `id`='$projectID' and `userid`='$userid'";
        if (mysqli_query($conn, $query)) {
            echo json_encode(['success' => ['message' => 'File saved successfully!', 'id' => $projectID]]);
        } else {
            echo json_encode(['error' => 'Something went wrong!']);
        }
    } else {
        echo json_encode(['error' => 'File not uploaded!']);
    }
} else {
    echo json_encode(['error' => 'Required fileds are missing!']);
}
