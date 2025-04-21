<?php
class Book {
    private $conn;
    private $table = 'books';

    public $id;
    public $titulo;
    public $ano_publicacao;
    public $num_paginas;
    public $id_autor;
    public $id_genero;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT b.*, a.nome as autor_nome, g.nome as genero_nome 
                  FROM ' . $this->table . ' b
                  JOIN authors a ON b.id_autor = a.id
                  JOIN genres g ON b.id_genero = g.id
                  ORDER BY b.titulo';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' 
                  (titulo, ano_publicacao, num_paginas, id_autor, id_genero)
                  VALUES (:titulo, :ano_publicacao, :num_paginas, :id_autor, :id_genero)
                  RETURNING id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':ano_publicacao', $this->ano_publicacao);
        $stmt->bindParam(':num_paginas', $this->num_paginas);
        $stmt->bindParam(':id_autor', $this->id_autor);
        $stmt->bindParam(':id_genero', $this->id_genero);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function getById($id) {
        $query = 'SELECT b.*, a.nome as autor_nome, g.nome as genero_nome 
                  FROM ' . $this->table . ' b
                  JOIN authors a ON b.id_autor = a.id
                  JOIN genres g ON b.id_genero = g.id
                  WHERE b.id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' 
                  SET titulo = :titulo,
                      ano_publicacao = :ano_publicacao,
                      num_paginas = :num_paginas,
                      id_autor = :id_autor,
                      id_genero = :id_genero
                  WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':ano_publicacao', $this->ano_publicacao);
        $stmt->bindParam(':num_paginas', $this->num_paginas);
        $stmt->bindParam(':id_autor', $this->id_autor);
        $stmt->bindParam(':id_genero', $this->id_genero);
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