<?php 

class ServiceContainer{
    private $pdo;
    private $studentsLoader;
    private $studentsStorage;

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

    public function getStudentsStorage(){
        if($this->studentsStorage === null){
            $this->studentsStorage = new StudentsStorage($this->getPDO());
        }

        return $this->studentsStorage;
    }
}