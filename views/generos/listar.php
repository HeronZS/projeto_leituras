<?php
require_once '../../config/database.php';
require_once '../../models/Genre.php';

$database = new Database();
$db = $database->connect();

$genre = new Genre($db);
$result = $genre->read();
$genres = $result->fetchAll(PDO::FETCH_ASSOC);

require_once '../../views/header.php';
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-tags me-2"></i>Gêneros Literários
        </h2>
        <a href="cadastrar.php" class="btn btn-success btn-lg rounded-circle" data-bs-toggle="tooltip" title="Adicionar novo gênero">
            <i class="bi bi-plus-lg">+</i>
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th width="10%">ID</th>
                            <th>Gênero</th>
                            <th width="25%" class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($genres)): ?>
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">
                                    <i class="bi bi-tag fs-1 d-block mb-3"></i>
                                    Nenhum gênero cadastrado ainda
                                    <div class="mt-3">
                                        <a href="cadastrar.php" class="btn btn-outline-primary">
                                            <i class="bi bi-plus-circle"></i> Adicionar Primeiro Gênero
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($genres as $genre): ?>
                            <tr>
                                <td><?php echo $genre['id']; ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-info text-dark me-2">
                                            <i class="bi bi-tag-fill"></i>
                                        </span>
                                        <span class="fw-medium"><?php echo htmlspecialchars($genre['nome']); ?></span>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="editar.php?id=<?php echo $genre['id']; ?>" 
                                           class="btn btn-sm btn-outline-primary rounded-start"
                                           data-bs-toggle="tooltip" 
                                           title="Editar gênero">
                                            <i class="bi bi-pencil">Editar</i>
                                        </a>
                                        <a href="excluir.php?id=<?php echo $genre['id']; ?>" 
                                           class="btn btn-sm btn-outline-danger rounded-end"
                                           onclick="return confirm('Tem certeza que deseja excluir este gênero?\nTodos os livros vinculados perderão esta classificação.')"
                                           data-bs-toggle="tooltip" 
                                           title="Excluir gênero">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href*="excluir.php"]').forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Tem certeza que deseja excluir este gênero?\n⚠️ Todos os livros vinculados perderão esta classificação.\nEsta ação não pode ser desfeita.')) {
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