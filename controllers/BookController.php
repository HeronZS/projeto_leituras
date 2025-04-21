<?php
require_once (__DIR__ . '/../models/Book.php');
require_once (__DIR__ . '/../models/Author.php');
require_once (__DIR__ . '/../models/Genre.php');
require_once (__DIR__ . '/../config/database.php');

class BookController {
    private $db;
    private $book;
    private $author;
    private $genre;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->book = new Book($this->db);
        $this->author = new Author($this->db);
        $this->genre = new Genre($this->db);
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['_method'])) {
                if ($_POST['_method'] === 'PUT') {
                    $this->update($_POST);
                }
            } else {
                $this->create($_POST);
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'delete':
                        $this->delete($_GET['id']);
                        break;
                }
            }
        }
    }

    private function create($data) {
        $this->book->titulo = $data['titulo'];
        $this->book->ano_publicacao = $data['ano_publicacao'];
        $this->book->num_paginas = $data['num_paginas'];
        $this->book->id_autor = $data['id_autor'];
        $this->book->id_genero = $data['id_genero'];

        if ($this->book->create()) {
            header('Location: /projeto_leituras/views/livros/listar.php');
            exit;
        } else {
            header('Location: /projeto_leituras/views/livros/cadastrar.php?error=1');
            exit;
        }
    }

    private function update($data) {
        $this->book->id = $data['id'];
        $this->book->titulo = $data['titulo'];
        $this->book->ano_publicacao = $data['ano_publicacao'];
        $this->book->num_paginas = $data['num_paginas'];
        $this->book->id_autor = $data['id_autor'];
        $this->book->id_genero = $data['id_genero'];

        if ($this->book->update()) {
            header('Location: /projeto_leituras/views/livros/listar.php');
            exit;
        } else {
            header('Location: /projeto_leituras/views/livros/editar.php?id=' . $data['id'] . '&error=1');
            exit;
        }
    }

    public function delete($id) {
        $this->book->id = $id;
        if ($this->book->delete()) {
            header('Location: /projeto_leituras/views/livros/listar.php');
            exit;
        } else {
            header('Location: /projeto_leituras/views/livros/listar.php?error=1');
            exit;
        }
    }

    public function getBook($id) {
        return $this->book->getById($id);
    }

    public function getAllAuthors() {
        $result = $this->author->read();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllGenres() {
        $result = $this->genre->read();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

$controller = new BookController();
$controller->handleRequest();
?>