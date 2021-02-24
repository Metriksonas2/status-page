<?php 

require_once(__DIR__ . "/../../bootstrap.php");

class StudentsLoader{

    private $studentsStorage;
    private $studentsCount;
    private $projectStudentsCount;

    public function __construct(StudentsStorage $studentsStorage)
    {
        $this->studentsStorage = $studentsStorage;
    }

    public function getStudents(){
        $fetchedStudents = $this->studentsStorage->fetchAll();

        $this->studentsCount = count($fetchedStudents);

        return $this->addStudentsToArray($fetchedStudents);
    }

    public function getProjectStudents($project_id){
        $fetchedStudents = $this->studentsStorage->fetchProjectStudents($project_id);

        $this->projectStudentsCount = count($fetchedStudents);

        return $this->addStudentsToArray($fetchedStudents);
    }

    public function getGroupStudents($group_id){
        $fetchedStudents = $this->studentsStorage->fetchGroupStudents($group_id);

        return $this->addStudentsToArray($fetchedStudents);
    }

    
    private function convertStudentToObject($student){
        global $configuration;
        $serviceContainer = new ServiceContainer($configuration);
        $groupsLoader = $serviceContainer->getGroupsLoader();

        $group = $groupsLoader->getGroup($student["group_id"]);
        if($group !== null){
            $groupName = $group->getName();
        }
        else{
            $groupName = null;
        }
        
        $newStudent = new Student($student["id"], $student["first_name"], $student["last_name"], $groupName);

        return $newStudent;
    }

    private function addStudentsToArray($students){
        $students_arr = [];

        foreach($students as $student){
            $students_arr[] = $this->convertStudentToObject($student);
        }

        return $students_arr;
    }

    /**
     * Get the value of studentsCount
     */ 
    public function getStudentsCount()
    {
        return $this->studentsCount;
    }

    /**
     * Get the value of projectStudentsCount
     */ 
    public function getProjectStudentsCount()
    {
        return $this->projectStudentsCount;
    }
}