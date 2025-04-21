<?php
require_once (__DIR__ . '/../models/Author.php');
require_once (__DIR__ . '/../config/database.php');

class AuthorController {
    private $db;
    private $author;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->author = new Author($this->db);
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
        $this->author->nome = $data['nome'];
        $this->author->nacionalidade = $data['nacionalidade'];
        $this->author->data_nascimento = $data['data_nascimento'];

        if ($this->author->create()) {
            header('Location: /projeto_leituras/views/autores/listar.php');
            exit;
        } else {
            header('Location: /projeto_leituras/views/autores/cadastrar.php?error=1');
            exit;
        }
    }

    private function update($data) {
        $this->author->id = $data['id'];
        $this->author->nome = $data['nome'];
        $this->author->nacionalidade = $data['nacionalidade'];
        $this->author->data_nascimento = $data['data_nascimento'];

        if ($this->author->update()) {
            header('Location: /projeto_leituras/views/autores/listar.php');
            exit;
        } else {
            header('Location: /projeto_leituras/views/autores/editar.php?id=' . $data['id'] . '&error=1');
            exit;
        }
    }

    public function delete($id) {
        $this->author->id = $id;
        if ($this->author->delete()) {
            header('Location: /projeto_leituras/views/autores/listar.php');
            exit;
        } else {
            header('Location: /projeto_leituras/views/autores/listar.php?error=1');
            exit;
        }
    }

    public function getAuthor($id) {
        return $this->author->getById($id);
    }
}

$controller = new AuthorController();
$controller->handleRequest();
?>