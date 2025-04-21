<?php
require_once (__DIR__ . '/../models/Reading.php');
require_once (__DIR__ . '/../models/Book.php');
require_once (__DIR__ . '/../config/database.php');

class ReadingController {
    private $db;
    private $reading;
    private $book;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->reading = new Reading($this->db);
        $this->book = new Book($this->db);
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
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {}
    }

    private function create($data) {
        $this->reading->id_livro = $data['id_livro'];
        $this->reading->data_inicial = $data['data_inicial'];
        $this->reading->data_final = $data['data_final'];
        $this->reading->nota = $data['nota'];
        $this->reading->comentario = $data['comentario'];

        if ($this->reading->create()) {
            header('Location: ../views/leituras/listar.php');
            exit;
        } else {
            header('Location: ../views/leituras/cadastrar.php?error=1');
            exit;
        }
    }

    public function update($data) {
        $this->reading->id = $data['id'];
        $this->reading->id_livro = $data['id_livro'];
        $this->reading->data_inicial = $data['data_inicial'];
        $this->reading->data_final = $data['data_final'];
        $this->reading->nota = $data['nota'];
        $this->reading->comentario = $data['comentario'];

        if ($this->reading->update()) {
            header('Location: ../views/leituras/listar.php');
            exit;
        } else {
            header('Location: ../views/leituras/editar.php?id=' . $data['id'] . '&error=1');
            exit;
        }
    }

    public function delete($id) {
        $this->reading->id = $id;
        if ($this->reading->delete()) {
            header('Location: ../views/leituras/listar.php');
            exit;
        } else {
            header('Location: ../views/leituras/listar.php?error=1');
            exit;
        }
    }

    public function getReading($id) {
        return $this->reading->getById($id);
    }

    public function getAllBooks() {
        $result = $this->book->read();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

$controller = new ReadingController();
$controller->handleRequest();
?>