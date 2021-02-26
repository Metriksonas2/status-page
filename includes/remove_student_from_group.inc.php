<?php

require_once("../bootstrap.php");

$serviceContainer = new ServiceContainer($configuration);
$pdo = $serviceContainer->getPDO();

if(isset($_POST["group_id"])){
    $group_id = $_POST["group_id"];
    $student_id = $_POST["student_id"];
    $project_id = $_POST["project_id"];

    $sql = "UPDATE students SET group_id = NULL WHERE id = :student_id;
            UPDATE groups SET student_count = student_count - 1 WHERE id = :group_id;";
    
    if($stmt = $pdo->prepare($sql)){
        
        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
        $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);

        if($stmt->execute()){
            header("location: ../project.php?id=" . $project_id . "#" . $group_id);
        }
        else{
            echo "Something went wrong. Please try again later.";
        }

        unset($stmt);
    }   
}