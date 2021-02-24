<?php

class Student{

    private $id;
    private $first_name;
    private $last_name;
    private $group;

    public function __construct($id, $first_name, $last_name, $group)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        
        $this->setGroup($group);
    }

    public function __toString(){
        return sprintf("%s %s", $this->first_name, $this->last_name);
    }

    /**
     * Get the value of first_name
     */ 
    public function getFirst_name()
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     *
     * @return  self
     */ 
    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of last_name
     */ 
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     *
     * @return  self
     */ 
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of group
     */ 
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set the value of group
     *
     * @return  self
     */ 
    private function setGroup($group)
    {
        if($group !== null){
            $this->group = $group;
        }
        else{
            $this->group = "No group";
        }

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
}

