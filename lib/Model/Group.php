<?php 

class Group{

    private $id;
    private $project_id;
    private $name;

    public function __construct($id, $project_id, $name)
    {
        $this->id = $id;
        $this->project_id = $project_id;
        $this->name = $name;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of project_id
     */ 
    public function getProject_id()
    {
        return $this->project_id;
    }
    
    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }
}