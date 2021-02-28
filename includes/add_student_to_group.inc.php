<?php

require_once("../bootstrap.php");

$serviceContainer = new ServiceContainer($configuration);
$studentsLoader = $serviceContainer->getStudentsLoader();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $group_id = $_POST["group_id"];
    $student_id = $_POST["student_id"];
    $project_id = $_POST["project_id"];

    if($studentsLoader->addStudentToGroup($student_id, $group_id)){
        header("location: ../project.php?id=" . $project_id . "#" . $group_id);
    }
    else{
        echo "Something went wrong. Please try again later.";
    }  
}