<?php 

class StudentsLoader extends Loader{

    private $studentsCount;
    private $projectStudentsCount;

    public function __construct(StudentsStorage $studentsStorage)
    {
        parent::__construct($studentsStorage);
    }

    public function getStudents(){
        $fetchedStudents = $this->storage->fetchAll();

        $this->studentsCount = count($fetchedStudents);

        return $this->addStudentsToArray($fetchedStudents);
    }

    public function getProjectStudents($project_id){
        $fetchedStudents = $this->storage->fetchProjectStudents($project_id);

        $this->projectStudentsCount = count($fetchedStudents);

        return $this->addStudentsToArray($fetchedStudents);
    }

    public function getGroupStudents($group_id){
        $fetchedStudents = $this->storage->fetchGroupStudents($group_id);

        return $this->addStudentsToArray($fetchedStudents);
    }

    public function getNotGroupStudents($project_id, $group_id){
        $fetchedStudents = $this->storage->fetchNotGroupStudents($project_id, $group_id);

        return $this->addStudentsToArray($fetchedStudents);
    }

    public function addNewStudent($first_name, $last_name, $project_id, $group_id){
        return $this->storage->addNewStudent($first_name, $last_name, $project_id, $group_id);
    }

    public function addStudentToGroup($student_id, $group_id){
        return $this->storage->addStudentToGroup($student_id, $group_id);
    }

    public function removeStudentFromGroup($student_id, $group_id){
        return $this->storage->removeStudentFromGroup($student_id, $group_id);
    }

    public function deleteStudentFromProject($student_id, $group_id){
        return $this->storage->deleteStudent($student_id, $group_id);
    }

    public function studentExists($first_name, $last_name, $project_id){
        return $this->storage->checkIfStudentExists($first_name, $last_name, $project_id);
    }
    
    protected function convertToObject($student){
        $groupName = $this->getStudentGroupName($student["id"]);
        
        $newStudent = new Student($student["id"], $student["first_name"], $student["last_name"], $student["group_id"], $groupName);

        return $newStudent;
    }

    private function addStudentsToArray($students){
        $students_arr = [];

        foreach($students as $student){
            $students_arr[] = $this->convertToObject($student);
        }

        return $students_arr;
    }

    private function getStudentGroupName($student_id){
        return $this->storage->fetchStudentGroupName($student_id)["name"];
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