<?php 

class ServiceContainer{
    private $pdo;
    private $studentsLoader;
    private $studentsStorage;
    private $projectsLoader;
    private $projectsStorage;

    private $configuration;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    
    public function getPDO(){
        if($this->pdo === null){
            $this->pdo = new PDO(
                $this->configuration["db_dsn"],
                $this->configuration["db_user"],
                $this->configuration["db_pass"],
            );
            
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    public function getStudentsLoader(){
        if($this->studentsLoader === null){
            $this->studentsLoader = new StudentsLoader($this->getStudentsStorage());
        }

        return $this->studentsLoader;
    }

    private function getStudentsStorage(){
        if($this->studentsStorage === null){
            $this->studentsStorage = new StudentsStorage($this->getPDO());
        }

        return $this->studentsStorage;
    }

    public function getProjectsLoader(){
        if($this->projectsLoader === null){
            $this->projectsLoader = new ProjectsLoader($this->getProjectsStorage());
        }

        return $this->projectsLoader;
    }

    private function getProjectsStorage(){
        if($this->projectsStorage === null){
            $this->projectsStorage = new ProjectsStorage($this->getPDO());
        }

        return $this->projectsStorage;
    }
}