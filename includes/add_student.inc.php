<?php

require_once("../bootstrap.php");

$serviceContainer = new ServiceContainer($configuration);
$studentsLoader = $serviceContainer->getStudentsLoader();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $project_id = $_POST["project_id"];
    $group_id = !empty($_POST["group"]) ? $_POST["group"] : null;

    if(!$studentsLoader->studentExists($first_name, $last_name, $project_id)){

        if($studentsLoader->addNewStudent($first_name, $last_name, $project_id, $group_id)){
            header("location: ../project.php?id=" . $project_id . "&success=" . MessageHandler::SUCCESS_STUDENT_ADDED);
        }
        else{
            echo "Something went wrong. Please try again later.";
        }
    }
    else{
        header("location: ../project.php?id=" . $project_id . "&err=" . MessageHandler::ERR_STUDENT_EXISTS);
    }
}