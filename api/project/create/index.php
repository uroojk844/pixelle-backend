<?php
include_once("../../../config.php");

$headers = apache_request_headers();

if(isset($_POST['name']) && isset($_FILES['files']) && isset($headers['Authorization'])){
    $user = explode("|",$headers['Authorization']);
    $userid = $user[1];
    $title = $_POST['name'];
    $tags = $_POST['tags'];

    // uploading files
    if(isset($_FILES['files'])){
        $dir = "../../../ui";
        if(!file_exists($dir)) mkdir($dir);
        
        $projectID = uniqid();
        $filepath = "$dir/$projectID";
        $files = array();

        $uploaded = false;
        if(!file_exists($filepath)){
            mkdir($filepath, true);
            for ($file=0; $file < count($_FILES['files']['name']); $file++) {
                $name = $_FILES['files']['name'][$file];
                if(str_ends_with($name,'htm') || str_ends_with($name,'html')){
                    $name = 'index.html';
                }
                $files[] = $name;
                $temp_name = $_FILES['files']['tmp_name'][$file];
                if(move_uploaded_file($temp_name, "$filepath/$name")){
                    $uploaded = true;
                }else $uploaded = false;
            }
            if($uploaded){
                // updating in data base
                $files = implode(",",$files);
                $query = "INSERT INTO `projects`(`id`, `userid`, `files`, `name`, `tags`) values('$projectID', '$userid', '$files', '$title', '$tags')";
                if(mysqli_query($conn, $query)) {
                    echo json_encode(['success'=>['message'=>'File uploaded successfully!','id'=>$projectID]]);
                }else{
                    echo json_encode(['error'=>'Something went wrong!']);
                }
            }else{
                echo json_encode(['error'=>'File not uploaded!']);
            }
        }else{
            echo json_encode(['error'=>'Folder already exists!']);
        }
    }
}else{
    print_r($data['name']);
    echo json_encode(['error'=>'Required fileds are missing!']);
}
?>