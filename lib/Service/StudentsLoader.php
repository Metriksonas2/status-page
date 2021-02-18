<?php 

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

    
    private function convertStudentToObject($student){
        $newStudent = new Student($student["first_name"], $student["last_name"]);

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