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

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-bookmark-check me-2"></i>Minhas Leituras
        </h2>
        <a href="cadastrar.php" class="btn btn-success btn-lg rounded-pill" data-bs-toggle="tooltip" title="Registrar nova leitura">
            <i class="bi bi-plus-lg me-2"></i>Nova Leitura
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="25%">Livro</th>
                            <th width="15%">Início</th>
                            <th width="15%">Término</th>
                            <th width="20%">Avaliação</th>
                            <th width="20%" class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($readings)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-journal-x fs-1 d-block mb-3"></i>
                                    Nenhuma leitura registrada ainda
                                    <div class="mt-3">
                                        <a href="cadastrar.php" class="btn btn-outline-primary">
                                            <i class="bi bi-plus-circle"></i> Registrar Primeira Leitura
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($readings as $reading): ?>
                            <tr>
                                <td><?php echo $reading['id']; ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-book me-2 text-muted"></i>
                                        <?php echo htmlspecialchars($reading['livro_titulo']); ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        <i class="bi bi-calendar-start me-1"></i>
                                        <?php echo date('d/m/Y', strtotime($reading['data_inicial'])); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        <i class="bi bi-calendar-check me-1"></i>
                                        <?php echo date('d/m/Y', strtotime($reading['data_final'])); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="star-rating" data-rating="<?php echo $reading['nota']; ?>">
                                        <?php for ($i = 1; $i <= 10; $i++): ?>
                                            <i class="bi bi-star<?php echo $i <= $reading['nota'] ? '-fill' : ''; ?> text-warning"></i>
                                        <?php endfor; ?>
                                        <small class="ms-2 fw-bold"><?php echo $reading['nota']; ?>/10</small>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="detalhes.php?id=<?php echo $reading['id']; ?>" 
                                           class="btn btn-sm btn-outline-info"
                                           data-bs-toggle="tooltip" 
                                           title="Ver detalhes">
                                            <i class="bi bi-eye">Detalhes</i>
                                        </a>
                                        <a href="editar.php?id=<?php echo $reading['id']; ?>" 
                                           class="btn btn-sm btn-outline-primary"
                                           data-bs-toggle="tooltip" 
                                           title="Editar registro">
                                            <i class="bi bi-pencil">Editar</i>
                                        </a>
                                        <a href="excluir.php?id=<?php echo $reading['id']; ?>" 
                                           class="btn btn-sm btn-outline-danger"
                                           data-bs-toggle="tooltip" 
                                           title="Excluir registro"
                                           onclick="return confirm('Tem certeza que deseja excluir esta leitura?\nEsta ação não pode ser desfeita.')">
                                            <i class="bi bi-trash">Excluir</i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .star-rating {
        font-size: 1.1rem;
        line-height: 1;
    }
    .star-rating .bi-star-fill {
        color: gold;
    }
    .badge {
        padding: 0.4em 0.6em;
        font-weight: 500;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href*="excluir.php"]').forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Tem certeza que deseja excluir este registro de leitura?\nEsta ação não pode ser desfeita.')) {
                e.preventDefault();
            }
        });
    });
    
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (el) {
        return new bootstrap.Tooltip(el);
    });
});
</script>

<?php
require_once '../../views/footer.php';
?>