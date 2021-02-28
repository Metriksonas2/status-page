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

    public function getGroupStudents($group_id){
        $fetchedStudents = $this->studentsStorage->fetchGroupStudents($group_id);

        return $this->addStudentsToArray($fetchedStudents);
    }

    public function getNotGroupStudents($project_id, $group_id){
        $fetchedStudents = $this->studentsStorage->fetchNotGroupStudents($project_id, $group_id);

        return $this->addStudentsToArray($fetchedStudents);
    }

    public function studentExists($first_name, $last_name, $project_id){
        return $this->studentsStorage->checkIfStudentExists($first_name, $last_name, $project_id);
    }
    
    private function convertStudentToObject($student){
        $groupName = $this->getStudentGroupName($student["id"]);
        
        $newStudent = new Student($student["id"], $student["first_name"], $student["last_name"], $student["group_id"], $groupName);

        return $newStudent;
    }

    private function addStudentsToArray($students){
        $students_arr = [];

        foreach($students as $student){
            $students_arr[] = $this->convertStudentToObject($student);
        }

        return $students_arr;
    }

    private function getStudentGroupName($student_id){
        return $this->studentsStorage->fetchStudentGroupName($student_id)["name"];
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