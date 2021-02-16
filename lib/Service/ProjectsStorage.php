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
}