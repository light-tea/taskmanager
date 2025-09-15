<?php

require_once 'Database.php';

class Task {
    private $db;
    private $conn;
    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->connect();
    }


    //create task
    public function create ($title, $description, $status) {
        $query = "INSERT INTO task (title, description, status) VALUES (:title, :description, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    //read tasks
    public function readAll() {
        $query = "SELECT * FROM task";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //read single task
    public function readOne($id) {
        $query = "SELECT * FROM task WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //update task
    public function update($id, $title, $description, $status) {
        $query = "UPDATE task SET title = :title, description = :description, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    //delete task
    public function delete($id) {
        $query = 'DELETE FROM task WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();   
    }
}
?>
