<?php
class Reading {
    private $conn;
    private $table = 'readings';

    public $id;
    public $id_livro;
    public $data_inicial;
    public $data_final;
    public $nota;
    public $comentario;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT r.*, b.titulo as livro_titulo 
                  FROM ' . $this->table . ' r
                  JOIN books b ON r.id_livro = b.id
                  ORDER BY r.data_final DESC';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' 
                  (id_livro, data_inicial, data_final, nota, comentario)
                  VALUES (:id_livro, :data_inicial, :data_final, :nota, :comentario)
                  RETURNING id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_livro', $this->id_livro);
        $stmt->bindParam(':data_inicial', $this->data_inicial);
        $stmt->bindParam(':data_final', $this->data_final);
        $stmt->bindParam(':nota', $this->nota);
        $stmt->bindParam(':comentario', $this->comentario);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function getById($id) {
        $query = 'SELECT r.*, b.titulo as livro_titulo 
                  FROM ' . $this->table . ' r
                  JOIN books b ON r.id_livro = b.id
                  WHERE r.id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' 
                  SET id_livro = :id_livro, 
                      data_inicial = :data_inicial, 
                      data_final = :data_final, 
                      nota = :nota, 
                      comentario = :comentario
                  WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_livro', $this->id_livro);
        $stmt->bindParam(':data_inicial', $this->data_inicial);
        $stmt->bindParam(':data_final', $this->data_final);
        $stmt->bindParam(':nota', $this->nota);
        $stmt->bindParam(':comentario', $this->comentario);
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