<?php 

abstract class Storage{

    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    abstract public function fetchAll();
}