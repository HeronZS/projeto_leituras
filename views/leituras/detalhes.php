<?php
require_once '../../config/database.php';
require_once '../../models/Reading.php';
require_once '../../controllers/ReadingController.php';

$database = new Database();
$db = $database->connect();

$controller = new ReadingController();
$reading = $controller->getReading($_GET['id']);

require_once '../../views/header.php';
?>

<h2>Detalhes da Leitura</h2>

<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($reading['livro_titulo']); ?></h5>
        <p class="card-text">
            <strong>Data de Início:</strong> <?php echo date('d/m/Y', strtotime($reading['data_inicial'])); ?><br>
            <strong>Data de Término:</strong> <?php echo date('d/m/Y', strtotime($reading['data_final'])); ?><br>
            <strong>Nota:</strong> 
            <?php 
            for ($i = 1; $i <= 10; $i++) {
                echo $i <= $reading['nota'] ? '★' : '☆';
            }
            ?><br>
            <strong>Comentário:</strong> <?php echo nl2br(htmlspecialchars($reading['comentario'])); ?>
        </p>
        <a href="editar.php?id=<?php echo $reading['id']; ?>" class="btn btn-warning">Editar</a>
        <a href="listar.php" class="btn btn-secondary">Voltar</a>
    </div>
</div>

<?php
require_once '../../views/footer.php';
?>