<?php
require_once '../../config/database.php';
require_once '../../models/Author.php';
require_once '../../models/Genre.php';

$database = new Database();
$db = $database->connect();

// Buscar autores e gêneros para os selects
$author = new Author($db);
$authors_result = $author->read();
$authors = $authors_result->fetchAll(PDO::FETCH_ASSOC);

$genre = new Genre($db);
$genres_result = $genre->read();
$genres = $genres_result->fetchAll(PDO::FETCH_ASSOC);

require_once '../../views/header.php';
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="bi bi-book-plus me-2"></i>Cadastrar Novo Livro
                    </h3>
                </div>
                <div class="card-body">
                    <form action="../../controllers/BookController.php" method="post" id="bookForm">
                        <div class="mb-3">
                            <label for="titulo" class="form-label fw-bold">Título do Livro</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-bookmark"></i>
                                </span>
                                <input type="text" class="form-control" id="titulo" name="titulo" 
                                       placeholder="Digite o título do livro" required>
                            </div>
                            <div class="invalid-feedback">Por favor, insira o título do livro.</div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="ano_publicacao" class="form-label fw-bold">Ano de Publicação</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-calendar"></i>
                                    </span>
                                    <input type="number" class="form-control" id="ano_publicacao" name="ano_publicacao" 
                                           min="1000" max="<?php echo date('Y') + 5; ?>" 
                                           placeholder="Ex: 1997" required>
                                </div>
                                <div class="invalid-feedback">Informe um ano válido.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="num_paginas" class="form-label fw-bold">Número de Páginas</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-file-text"></i>
                                    </span>
                                    <input type="number" class="form-control" id="num_paginas" name="num_paginas" 
                                           min="1" placeholder="Ex: 256" required>
                                </div>
                                <div class="invalid-feedback">Informe um número válido.</div>
                            </div>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="id_autor" class="form-label fw-bold">Autor</label>
                            <select class="form-select" id="id_autor" name="id_autor" required>
                                <option value="" selected disabled>Selecione um autor...</option>
                                <?php foreach ($authors as $author): ?>
                                <option value="<?php echo $author['id']; ?>">
                                    <?php echo htmlspecialchars($author['nome']); ?>
                                    <?php if (!empty($author['nacionalidade'])): ?>
                                        (<?php echo htmlspecialchars($author['nacionalidade']); ?>)
                                    <?php endif; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Por favor, selecione um autor.</div>
                            <small class="text-muted">Não encontrou o autor? <a href="../autores/cadastrar.php">Cadastre um novo</a></small>
                        </div>

                        <div class="mb-4">
                            <label for="id_genero" class="form-label fw-bold">Gênero Literário</label>
                            <select class="form-select" id="id_genero" name="id_genero" required>
                                <option value="" selected disabled>Selecione um gênero...</option>
                                <?php foreach ($genres as $genre): ?>
                                <option value="<?php echo $genre['id']; ?>"><?php echo htmlspecialchars($genre['nome']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Por favor, selecione um gênero.</div>
                            <small class="text-muted">Precisa de um novo gênero? <a href="../generos/cadastrar.php">Adicione aqui</a></small>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="listar.php" class="btn btn-outline-secondary me-md-2">
                                <i class="bi bi-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Cadastrar Livro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validação do formulário
    const form = document.getElementById('bookForm');
    const fields = form.querySelectorAll('[required]');
    
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        fields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            // Rola até o primeiro erro
            const firstInvalid = form.querySelector('.is-invalid');
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstInvalid.focus();
        }
    });
    
    // Validação em tempo real
    fields.forEach(field => {
        field.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });
});
</script>

<style>
    .form-control, .form-select {
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
    }
    .input-group-text {
        background-color: #f8f9fa;
    }
    .card {
        border-radius: 0.5rem;
    }
    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }
</style>

<?php
require_once '../../views/footer.php';
?>