<?php

// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type");

include_once(__DIR__ . "/../bootstrap.php");

$serviceContainer = new ServiceContainer($configuration);
$studentsLoader = $serviceContainer->getStudentsLoader();
$groupsLoader = $serviceContainer->getGroupsLoader();
$projectsLoader = $serviceContainer->getProjectsLoader();

// Add student to the project
if($_SERVER["REQUEST_METHOD"] === "POST"){

    // Body of the request
    $body = json_decode(file_get_contents("php://input"));

    $first_name = property_exists($body, "first_name") ? trim($body->first_name) : null;
    $last_name = property_exists($body, "last_name") ? trim($body->last_name) : null;
    $project_id = property_exists($body, "project_id") ? intval($body->project_id) : null;
    $group_id = null;
    $group_is_full = false;

    if(property_exists($body, "group_id")){
        $group_id = intval($body->group_id);  
        
        $group = $groupsLoader->getGroup($group_id);
        $project = $projectsLoader->getProjectById($project_id);
        $group_is_full = $group->getStudent_count() === $project->getMax_students();
    }

    if($first_name === null || $last_name === null || $project_id === null){
        echo json_encode(array(
            "error" => MessageHandler::getMessage(MessageHandler::ERR_MISSING_ARGUMENTS)
        ));
    }
    else if(!empty($first_name) && !empty($last_name) && $project_id > 0){

        if($group_is_full){
            echo json_encode(array(
                "error" => MessageHandler::getMessage(MessageHandler::ERR_GROUP_IS_FULL)
            ));
        }
        else if(!$studentsLoader->studentExists($first_name, $last_name, $project_id)){
            $studentsLoader->addNewStudent($first_name, $last_name, $project_id, $group_id);

            echo json_encode(array(
                "success" => MessageHandler::getMessage(MessageHandler::SUCCESS_STUDENT_ADDED)
            ));
        }
        else{
            echo json_encode(array(
                "error" => MessageHandler::getMessage(MessageHandler::ERR_STUDENT_EXISTS)
            ));
        }
    }
    else{
        echo json_encode(array(
            "error" => MessageHandler::getMessage(MessageHandler::ERR_INCORRECT_DATA)
        ));
    }
}