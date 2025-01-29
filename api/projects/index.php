<?php
    $projects = scandir("../../ui/");
    
    unset($projects[0]);
    unset($projects[1]);

    $filtered_projects = array();

    foreach ($projects as $project) {
        $user = explode("_", $project)[0];
        if(isset($_GET['user']) && $user == $_GET['user']) {
            $filtered_projects[] = $project;
        }
        elseif(!isset($_GET['user'])){
            $filtered_projects[] = $project;
        }
    }

    echo json_encode(['success'=> $filtered_projects]);
?>