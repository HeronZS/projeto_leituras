<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../controllers/BookController.php';

$database = new Database();
$db = $database->connect();

$controller = new BookController();
$book = $controller->getBook($_GET['id']);
$authors = $controller->getAllAuthors();
$genres = $controller->getAllGenres();

require_once (__DIR__ . '/../../views/header.php');
?>

<h2>Editar Livro</h2>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">Erro ao atualizar o livro. Por favor, tente novamente.</div>
<?php endif; ?>

<form method="POST" action="/projeto_leituras/controllers/BookController.php">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="id" value="<?php echo $book['id']; ?>">

    <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" 
               value="<?php echo htmlspecialchars($book['titulo']); ?>" required>
    </div>

    <div class="form-group">
        <label for="ano_publicacao">Ano de Publicação</label>
        <input type="number" class="form-control" id="ano_publicacao" name="ano_publicacao" 
               value="<?php echo htmlspecialchars($book['ano_publicacao']); ?>">
    </div>

    <div class="form-group">
        <label for="num_paginas">Número de Páginas</label>
        <input type="number" class="form-control" id="num_paginas" name="num_paginas" 
               value="<?php echo htmlspecialchars($book['num_paginas']); ?>">
    </div>

    <div class="form-group">
        <label for="id_autor">Autor</label>
        <select class="form-control" id="id_autor" name="id_autor" required>
            <?php foreach ($authors as $author): ?>
                <option value="<?php echo $author['id']; ?>" 
                    <?php echo $author['id'] == $book['id_autor'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($author['nome']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="id_genero">Gênero</label>
        <select class="form-control" id="id_genero" name="id_genero" required>
            <?php foreach ($genres as $genre): ?>
                <option value="<?php echo $genre['id']; ?>" 
                    <?php echo $genre['id'] == $book['id_genero'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($genre['nome']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="listar.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php
require_once (__DIR__ . '/../../views/footer.php');
?>