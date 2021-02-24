<?php

require_once("../bootstrap.php");

$serviceContainer = new ServiceContainer($configuration);
$pdo = $serviceContainer->getPDO();

if(isset($_POST["group_id"])){
    $group_id = $_POST["group_id"];
    $student_id = $_POST["student_id"];
    $project_id = $_POST["project_id"];

    $sql = "INSERT INTO student_in_group (group_id, student_id) VALUES (:group_id, :student_id);
            UPDATE students SET group_id = :group_id WHERE id = :student_id;";
    
    if($stmt = $pdo->prepare($sql)){

        $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);
        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);

        if($stmt->execute()){
            header("location: ../project.php?id=" . $project_id . "#" . $group_id);
        }
        else{
            echo "Something went wrong. Please try again later.";
        }

        unset($stmt);
    }   
}