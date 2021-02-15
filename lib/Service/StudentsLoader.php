<?php 

class StudentsLoader{

    private $studentsStorage;

    public function __construct(StudentsStorage $studentsStorage)
    {
        $this->studentsStorage = $studentsStorage;
    }

    public function getStudents(){
        $fetchedStudents = $this->studentsStorage->fetchAllStudents();

        $students = [];

        foreach($fetchedStudents as $student){
            $students[] = $this->convertStudentToObject($student);
        }

        return $students;
    }

    private function convertStudentToObject($student){
        $newStudent = new Student($student["first_name"], $student["last_name"]);

        return $newStudent;
    }
}