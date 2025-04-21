<?php
class Genre {
    private $conn;
    private $table = 'genres';

    public $id;
    public $nome;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY nome';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (nome) VALUES (:nome) RETURNING id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $this->nome);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function getById($id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET nome = :nome WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>