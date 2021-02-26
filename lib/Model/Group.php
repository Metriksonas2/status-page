<?php 

class Group{

    private $id;
    private $project_id;
    private $name;
    private $student_count;

    public function __construct($id, $project_id, $name, $student_count)
    {
        $this->id = $id;
        $this->project_id = $project_id;
        $this->name = $name;
        $this->student_count = $student_count;
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

    /**
     * Get the value of student_count
     */ 
    public function getStudent_count()
    {
        return $this->student_count;
    }
}