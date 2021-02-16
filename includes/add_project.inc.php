<?php

require_once("../bootstrap.php");

$serviceContainer = new ServiceContainer($configuration);
$pdo = $serviceContainer->getPDO();

if(isset($_POST["submit"])){
    $title = trim($_POST["title"]);
    $groups_count = $_POST["groups_count"];
    $max_students = $_POST["max_students"];

    $sql = "INSERT INTO projects (title, groups_count, max_students) VALUES (:title, :groups_count, :max_students)";
    
    if($stmt = $pdo->prepare($sql)){

        $stmt->bindParam(":title", $title, PDO::PARAM_STR);
        $stmt->bindParam(":groups_count", $groups_count, PDO::PARAM_INT);
        $stmt->bindParam(":max_students", $max_students, PDO::PARAM_INT);

        if($stmt->execute()){
            header("location: ../index.php?msg=projectadded");
        }
        else{
            echo "Something went wrong. Please try again later.";
        }

        unset($stmt);
    }  
}