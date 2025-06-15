<?php
require_once '../../config/database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

$author = new Author($db);
$result = $author->read();
$authors = $result->fetchAll(PDO::FETCH_ASSOC);

require_once '../../views/header.php';
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-person-badge me-2"></i>Autores Cadastrados
        </h2>
        <a href="cadastrar.php" class="btn btn-success btn-lg rounded-circle" data-bs-toggle="tooltip" title="Adicionar novo autor">
            <i class="bi bi-plus-lg">+</i>
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="25%">Nome</th>
                            <th width="20%">Nacionalidade</th>
                            <th width="20%">Nascimento</th>
                            <th width="30%" class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($authors)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-exclamation-circle fs-4 d-block mb-2"></i>
                                    Nenhum autor cadastrado ainda
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($authors as $author): ?>
                            <tr class="align-middle">
                                <td><?php echo $author['id']; ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person-circle me-2 text-muted"></i>
                                        <?php echo htmlspecialchars($author['nome']); ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <?php echo htmlspecialchars($author['nacionalidade']); ?>
                                    </span>
                                </td>
                                <td>
                                    <i class="bi bi-calendar-event me-1 text-muted"></i>
                                    <?php echo date('d/m/Y', strtotime($author['data_nascimento'])); ?>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="editar.php?id=<?php echo $author['id']; ?>" 
                                           class="btn btn-sm btn-outline-primary rounded-start"
                                           data-bs-toggle="tooltip" 
                                           title="Editar autor">
                                            <i class="bi bi-pencil">Editar</i>
                                        </a>
                                        <a href="excluir.php?id=<?php echo $author['id']; ?>" 
                                           class="btn btn-sm btn-outline-danger rounded-end"
                                           onclick="return confirm('Tem certeza que deseja excluir este autor?')"
                                           data-bs-toggle="tooltip" 
                                           title="Excluir autor">
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
document.querySelectorAll('a[href*="excluir.php"]').forEach(link => {
    link.addEventListener('click', function(e) {
        if (!confirm('Tem certeza que deseja excluir este autor?\nEsta ação não pode ser desfeita.')) {
            e.preventDefault();
        }
    });
});
</script>

<?php
require_once '../../views/footer.php';
?>