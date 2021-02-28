<?php

require_once("../bootstrap.php");

$serviceContainer = new ServiceContainer($configuration);
$projectsLoader = $serviceContainer->getProjectsLoader();
$groupsLoader = $serviceContainer->getGroupsLoader();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $title = trim($_POST["title"]);
    $groups_count = $_POST["groups_count"];
    $max_students = $_POST["max_students"];

    if(($project_id = $projectsLoader->addNewProject($title, $groups_count, $max_students))){
        
        if($groupsLoader->addGroups($project_id, $groups_count)){
            header("location: ../index.php?success=" . MessageHandler::SUCCESS_PROJECT_ADDED);
        }
    }
    else{
        echo "Something went wrong. Please try again later.";
    }
}