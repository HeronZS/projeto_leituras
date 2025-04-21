<?php
class Author {
    private $conn;
    private $table = 'authors';

    public $id;
    public $nome;
    public $nacionalidade;
    public $data_nascimento;

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
        $query = 'INSERT INTO ' . $this->table . ' 
                  (nome, nacionalidade, data_nascimento)
                  VALUES (:nome, :nacionalidade, :data_nascimento)
                  RETURNING id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':nacionalidade', $this->nacionalidade);
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);

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
        $query = 'UPDATE ' . $this->table . ' 
                  SET nome = :nome, 
                      nacionalidade = :nacionalidade, 
                      data_nascimento = :data_nascimento
                  WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':nacionalidade', $this->nacionalidade);
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);
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