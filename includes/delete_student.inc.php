<?php

require_once("../bootstrap.php");

$serviceContainer = new ServiceContainer($configuration);
$studentsLoader = $serviceContainer->getStudentsLoader();

if($_SERVER["REQUEST_METHOD"] === "POST"){    
    $group_id = isset($_POST["group_id"]) ? $_POST["group_id"] : null;
    $student_id = $_POST["student_id"];
    $project_id = $_POST["project_id"];
    
    if($studentsLoader->deleteStudentFromProject($student_id, $group_id))
        header("location: ../project.php?id=" . $project_id . "&success=" . MessageHandler::SUCCESS_STUDENT_DELETED);
    else{
        echo "Something went wrong. Please try again later.";
    }
}