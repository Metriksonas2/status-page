<?php 

class ProjectsStorage{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
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
     * Returns array of all projects
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
}