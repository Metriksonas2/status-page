<?php

require_once("../bootstrap.php");

$serviceContainer = new ServiceContainer($configuration);
$pdo = $serviceContainer->getPDO();

if(isset($_POST["submit"])){
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $project_id = $_POST["project_id"];

    if((isset($first_name) && !empty($first_name)) && (isset($last_name) && !empty($last_name))){
        $sql = "INSERT INTO students (first_name, last_name, project_id) VALUES (:first_name, :last_name, :project_id)";
        
        if($stmt = $pdo->prepare($sql)){

            $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
            $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
            $stmt->bindParam(":project_id", $project_id, PDO::PARAM_INT);

            if($stmt->execute()){
                header("location: ../project.php?id=" . $project_id);
            }
            else{
                echo "Something went wrong. Please try again later.";
            }

            unset($stmt);
        }   
    }
    else{
        header("Location: ../index.php?err=emptyfield");
    }
}