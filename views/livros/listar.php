<?php
require_once '../../config/database.php';
require_once '../../models/Book.php';

$database = new Database();
$db = $database->connect();

$book = new Book($db);
$result = $book->read();
$books = $result->fetchAll(PDO::FETCH_ASSOC);

require_once '../../views/header.php';
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-book me-2"></i>Biblioteca de Livros
        </h2>
        <a href="cadastrar.php" class="btn btn-success btn-lg rounded-pill" data-bs-toggle="tooltip" title="Adicionar novo livro">
            <i class="bi bi-plus-lg me-2"></i>Novo Livro
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="25%">Título</th>
                            <th width="10%">Ano</th>
                            <th width="10%">Págs</th>
                            <th width="20%">Autor</th>
                            <th width="15%">Gênero</th>
                            <th width="15%" class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($books)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-book fs-1 d-block mb-3"></i>
                                    Nenhum livro cadastrado ainda
                                    <div class="mt-3">
                                        <a href="cadastrar.php" class="btn btn-outline-primary">
                                            <i class="bi bi-plus-circle"></i> Adicionar Primeiro Livro
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($books as $book): ?>
                            <tr>
                                <td><?php echo $book['id']; ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-bookmark me-2 text-muted"></i>
                                        <span class="fw-medium"><?php echo htmlspecialchars($book['titulo']); ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        <?php echo $book['ano_publicacao']; ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        <?php echo $book['num_paginas']; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person me-2 text-muted"></i>
                                        <?php echo htmlspecialchars($book['autor_nome']); ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <?php echo htmlspecialchars($book['genero_nome']); ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="editar.php?id=<?php echo $book['id']; ?>" 
                                           class="btn btn-sm btn-outline-primary"
                                           data-bs-toggle="tooltip" 
                                           title="Editar livro">
                                            <i class="bi bi-pencil">Editar</i>
                                        </a>
                                        <a href="excluir.php?id=<?php echo $book['id']; ?>" 
                                           class="btn btn-sm btn-outline-danger"
                                           data-bs-toggle="tooltip" 
                                           title="Excluir livro"
                                           onclick="return confirm('Tem certeza que deseja excluir este livro?\n⚠️ Todos os registros de leitura vinculados serão removidos.\nEsta ação não pode ser desfeita.')">
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
    .badge {
        padding: 0.4em 0.6em;
        font-weight: 500;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
    .btn-group .btn {
        border-radius: 0;
    }
    .btn-group .btn:first-child {
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }
    .btn-group .btn:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (el) {
        return new bootstrap.Tooltip(el);
    });
    
    // Confirmação de exclusão
    document.querySelectorAll('a[href*="excluir.php"]').forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Tem certeza que deseja excluir este livro?\n⚠️ Todos os registros de leitura vinculados serão removidos.\nEsta ação não pode ser desfeita.')) {
                e.preventDefault();
            }
        });
    });
});
</script>

<?php
require_once '../../views/footer.php';
?>