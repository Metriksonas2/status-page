<?php 

class ProjectsStorage extends Storage{

    public function __construct($pdo)
    {
        parent::__construct($pdo);
    }

    /**
     * Returns array of all projects
     *
     * @return array
     */
    public function fetchAll(){
        $sql = "SELECT * FROM projects;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $projects;
    }

    /**
     * Returns array of single project
     *
     * @return array
     */
    public function fetchSingle($id){
        $sql = "SELECT * FROM projects
                WHERE id = :id;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
        if($stmt->execute() && $stmt->rowCount() == 1){
            
            $projects = $stmt->fetch(PDO::FETCH_ASSOC);
            return $projects;
        }
        else{
            echo "Fetch Error: " . $stmt->error;
        }
    }

    public function addNewProject($title, $groups_count, $max_students){
        $sql = "INSERT INTO projects (title, groups_count, max_students) VALUES (:title, :groups_count, :max_students);";

        if($stmt = $this->pdo->prepare($sql)){
            $stmt->bindParam(":title", $title, PDO::PARAM_STR);
            $stmt->bindParam(":groups_count", $groups_count, PDO::PARAM_INT);
            $stmt->bindParam(":max_students", $max_students, PDO::PARAM_INT);

            try {
                $stmt->execute();
    
                // Return last inserted ID, so that it could be passed for adding pre-made groups with that ID
                return $this->pdo->lastInsertId();
            } 
            catch (PDOException $e) {
                die("Insert Error: " . $e->getMessage());
            }
        }
    }

    public function checkIfProjectExists($project_id){
        $sql = "SELECT * FROM projects WHERE id = :project_id;";

        if($stmt = $this->pdo->prepare($sql)){

            $stmt->bindParam(":project_id", $project_id, PDO::PARAM_INT);

            try {
                $stmt->execute();
                
                return $stmt->rowCount() > 0;
            } catch (PDOException $e) {
                die("Fetch Error: " . $e->getMessage());
            }
        }
    }
}