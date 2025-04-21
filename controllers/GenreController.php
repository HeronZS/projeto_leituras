<?php
require_once (__DIR__ . '/../models/Genre.php');
require_once (__DIR__ . '/../config/database.php');

class GenreController {
    private $db;
    private $genre;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
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
            if (isset($_GET['action']) && $_GET['action'] === 'delete') {
                $this->delete($_GET['id']);
            }
        }
    }

    private function create($data) {
        $this->genre->nome = $data['nome'];

        if ($this->genre->create()) {
            header('Location: ../views/generos/listar.php');
            exit;
        } else {
            header('Location: ../views/generos/cadastrar.php?error=1');
            exit;
        }
    }

    private function update($data) {
        $this->genre->id = $data['id'];
        $this->genre->nome = $data['nome'];

        if ($this->genre->update()) {
            header('Location: ../views/generos/listar.php');
            exit;
        } else {
            header('Location: ../views/generos/editar.php?id=' . $data['id'] . '&error=1');
            exit;
        }
    }

    public function delete($id) {
        $this->genre->id = $id;
        if ($this->genre->delete()) {
            header('Location: ../generos/listar.php');
            exit;
        } else {
            header('Location: ../generos/listar.php?error=1');
            exit;
        }
    }

    public function getGenre($id) {
        return $this->genre->getById($id);
    }
}

$controller = new GenreController();
$controller->handleRequest();
?>