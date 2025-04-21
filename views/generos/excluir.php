<?php
require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../controllers/GenreController.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: listar.php?error=invalid_id");
    exit;
}

$controller = new GenreController();
$controller->delete($_GET['id']);
?>