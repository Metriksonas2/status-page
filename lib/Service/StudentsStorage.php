<?php 

class StudentsStorage{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Returns array of all students
     *
     * @return array
     */
    public function fetchAllStudents(){
        $sql = "SELECT * FROM students;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $students;
    }
}