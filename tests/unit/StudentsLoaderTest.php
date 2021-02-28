<?php

declare(strict_types = 1);
use PHPUnit\Framework\TestCase;

include_once(__DIR__ . "/../../bootstrap.php");
 
final class StudentsLoaderTest extends TestCase{

    public function testDeleteStudent(){

        // Arrange
        $first_name = "Test#1";
        $last_name = "Testas";
        $project_id = 1;
        $group_id = null;

        global $configuration;
        $serviceContainer = new ServiceContainer($configuration);
        $studentsLoader = $serviceContainer->getStudentsLoader();
        
        // Check if doesn't exist
        $this->assertFalse($studentsLoader->studentExists($first_name, $last_name, $project_id));

        // Adding to DB
        $student_id = $studentsLoader->addNewStudent($first_name, $last_name, $project_id, $group_id);

        // Check if exists after adding
        $this->assertTrue($studentsLoader->studentExists($first_name, $last_name, $project_id));

        // Deleting student from DB
        $studentsLoader->deleteStudentFromProject($student_id, $group_id);

        // Check if doesn't exist after deleting
        $this->assertFalse($studentsLoader->studentExists($first_name, $last_name, $project_id));
    }
}