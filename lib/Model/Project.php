<?php
class Project{

    private $id;
    private $title;
    private $group_count;
    private $max_students;

    public function __construct($id, $title, $group_count, $max_students)
    {
        $this->id = $id;
        $this->title = $title;
        $this->group_count = $group_count;
        $this->max_students = $max_students;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of group_count
     */ 
    public function getGroup_count()
    {
        return $this->group_count;
    }

    /**
     * Get the value of max_students
     */ 
    public function getMax_students()
    {
        return $this->max_students;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
}

