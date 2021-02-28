<?php

require_once(__DIR__ . "/lib/Service/ServiceContainer.php");
require_once(__DIR__ . "/lib/Service/MessageHandler.php");
require_once(__DIR__ . "/lib/Service/Storage.php");
require_once(__DIR__ . "/lib/Service/Loader.php");


require_once(__DIR__ . "/lib/Service/StudentsStorage.php");
require_once(__DIR__ . "/lib/Service/StudentsLoader.php");
require_once(__DIR__ . "/lib/Model/Student.php");

require_once(__DIR__ . "/lib/Service/ProjectsStorage.php");
require_once(__DIR__ . "/lib/Service/ProjectsLoader.php");
require_once(__DIR__ . "/lib/Model/Project.php");

require_once(__DIR__ . "/lib/Service/GroupsStorage.php");
require_once(__DIR__ . "/lib/Service/GroupsLoader.php");
require_once(__DIR__ . "/lib/Model/Group.php");

$db_host = "127.0.0.1";
// $db_name = "status_page";
$db_name = "check";
$db_user = "root";
$db_pass = "";

$configuration = [
    "db_dsn" => "mysql:host={$db_host};dbname={$db_name}",
    "db_user" => $db_user,
    "db_pass" => $db_pass
];