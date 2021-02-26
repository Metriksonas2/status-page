<?php 

class StudentsStorage{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Returns array of all students
     *
     * @return array
     */
    public function fetchAll(){
        $sql = "SELECT * FROM students;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $students;
    }

    public function fetchProjectStudents($project_id){
        $sql = "SELECT * FROM students WHERE project_id = :project_id;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":project_id", $project_id, PDO::PARAM_INT);
        
        if($stmt->execute()){
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $students;
        }
        else{
            echo "Fetch Error: " . $stmt->error;
        }
    }

    public function fetchGroupStudents($group_id){
        $sql = "SELECT * FROM students WHERE group_id = :group_id;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);
        
        if($stmt->execute()){
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $students;
        }
        else{
            echo "Fetch Error: " . $stmt->error;
        }
    }

    public function fetchStudentGroupName($student_id){
        $sql = "SELECT g.name FROM groups g
                INNER JOIN students s
                ON s.group_id = g.id
                WHERE s.id = :student_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
        
        if($stmt->execute()){
            $groupName = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($stmt->rowCount() > 0){
                return $groupName;
            }
            
            return array("name" => "No Group");
        }
        else{
            echo "Fetch Error: " . $stmt->error;
        }
    }

    public function fetchNotGroupStudents($project_id, $group_id){
        $sql = "SELECT * FROM students WHERE project_id = :project_id AND (group_id <> :group_id OR group_id IS NULL)";

        if($stmt = $this->pdo->prepare($sql)){

            $stmt->bindParam(":project_id", $project_id, PDO::PARAM_INT);
            $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);

            if($stmt->execute()){
                $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $students;
            }
            else{
                echo "Fetch Error: " . $stmt->error;
            }
        }
    }
}