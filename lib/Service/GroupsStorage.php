<?php 

class GroupsStorage extends Storage{

    public function __construct($pdo)
    {
        parent::__construct($pdo);
    }

    /**
     * Returns array of all students
     *
     * @return array
     */
    public function fetchAll(){
        $sql = "SELECT * FROM groups;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $groups;
    }

    public function fetchSingle($group_id){
        $sql = "SELECT * FROM groups WHERE id = :group_id;";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(":group_id", $group_id, PDO::PARAM_INT);

        $stmt->execute();

        $group = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount() > 0){
            return $group;
        }

        return null;
    }

    public function fetchProjectGroups($project_id){
        $sql = "SELECT * FROM groups WHERE project_id = :project_id;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":project_id", $project_id, PDO::PARAM_INT);
        
        if($stmt->execute()){
            $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $groups;
        }
        else{
            echo "Fetch Error: " . $stmt->error;
        }
    }

    public function fetchNotFullProjectGroups($project_id, $max_students){
        $sql = "SELECT * FROM groups WHERE project_id = :project_id AND student_count < :max_students";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":project_id", $project_id, PDO::PARAM_INT);
        $stmt->bindParam(":max_students", $max_students, PDO::PARAM_INT);

        try {
            $stmt->execute();
            $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $groups;
        } 
        catch (PDOException $e) {
            die("Fetch Error: " . $e->getMessage());
        }
    }

    public function addGroups($project_id, $groups_count){
        $sql = "";

        for($i = 1; $i <= $groups_count; $i++){
            $sql .= "INSERT INTO groups (project_id, name) VALUES ";
            $sql .= "({$project_id}, 'Group #{$i}'); ";
        }

        $stmt = $this->pdo->prepare($sql);
        try {
            $stmt->execute();

            return true;
        } 
        catch (PDOException $e) {
            die("Insert Error: " . $e->getMessage());
        }
    }
}