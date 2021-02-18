<?php 

class GroupsStorage{

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
        $sql = "SELECT * FROM groups;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $groups;
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

    public function addGroups($project_id, $groups_count){
        $sql = "";

        for($i = 1; $i <= $groups_count; $i++){
            $sql .= "INSERT INTO groups (project_id, name) VALUES ";
            $sql .= "({$project_id}, 'Group #{$i}'); ";
        }

        $stmt = $this->pdo->prepare($sql);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            die("Insert Error: " . $e->getMessage());
        }
    }
}