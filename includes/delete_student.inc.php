<?php

require_once("../bootstrap.php");

$serviceContainer = new ServiceContainer($configuration);
$pdo = $serviceContainer->getPDO();

// if($_SERVER["REQUEST_METHOD"] == "POST"){
if(isset($_POST["project_id"])){    
    $in_group = isset($_POST["group_id"]);
    $student_id = $_POST["student_id"];
    $project_id = $_POST["project_id"];
    
    $sql = "DELETE FROM students WHERE id = :student_id;";

    if($in_group){
        $group_id = $_POST["group_id"];

        $sql .= "UPDATE groups SET student_count = student_count - 1 WHERE id = :group_id;";    
    }

    if($stmt = $pdo->prepare($sql)){
        
        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);

        if($in_group){
            $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);
        }

        if($stmt->execute()){
            header("location: ../project.php?id=" . $project_id . "&msg=studentdeleted");
        }
        else{
            echo "Something went wrong. Please try again later.";
        }

        unset($stmt);
    }   
}