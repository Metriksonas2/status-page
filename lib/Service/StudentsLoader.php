<?php 

class StudentsLoader{

    private $studentsStorage;

    public function __construct(StudentsStorage $studentsStorage)
    {
        $this->studentsStorage = $studentsStorage;
    }

    public function getStudents(){
        $fetchedStudents = $this->studentsStorage->fetchAll();

        return $this->addStudentsToArray($fetchedStudents);
    }

    public function getProjectStudents($project_id){
        $fetchedStudents = $this->studentsStorage->fetchProjectStudents($project_id);

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
}