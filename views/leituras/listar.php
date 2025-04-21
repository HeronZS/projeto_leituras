<?php
require_once '../../config/database.php';
require_once '../../models/Reading.php';

$database = new Database();
$db = $database->connect();

$reading = new Reading($db);
$result = $reading->read();
$readings = $result->fetchAll(PDO::FETCH_ASSOC);

require_once '../../views/header.php';
?>

<h2>Minhas Leituras</h2>
<a href="cadastrar.php" class="btn btn-success mb-3">Registrar Nova Leitura</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Livro</th>
            <th>Início</th>
            <th>Término</th>
            <th>Nota</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($readings as $reading): ?>
        <tr>
            <td><?php echo $reading['id']; ?></td>
            <td><?php echo htmlspecialchars($reading['livro_titulo']); ?></td>
            <td><?php echo date('d/m/Y', strtotime($reading['data_inicial'])); ?></td>
            <td><?php echo date('d/m/Y', strtotime($reading['data_final'])); ?></td>
            <td>
                <?php 
                for ($i = 1; $i <= 10; $i++) {
                    echo $i <= $reading['nota'] ? '★' : '☆';
                }
                ?>
            </td>
            <td>
                <a href="detalhes.php?id=<?php echo $reading['id']; ?>" class="btn btn-sm btn-info">Detalhes</a>
                <a href="editar.php?id=<?php echo $reading['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="excluir.php?id=<?php echo $reading['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir o registro?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
require_once '../../views/footer.php';
?>