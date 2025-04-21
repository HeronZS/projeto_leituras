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

<h2>Cadastrar Novo Livro</h2>
<form action="../../controllers/BookController.php" method="post">
    <div class="form-group">
        <label for="titulo">Título:</label>
        <input type="text" class="form-control" id="titulo" name="titulo" required>
    </div>
    
    <div class="form-group mt-3">
        <label for="ano_publicacao">Ano de Publicação:</label>
        <input type="number" class="form-control" id="ano_publicacao" name="ano_publicacao" required>
    </div>
    
    <div class="form-group mt-3">
        <label for="num_paginas">Número de Páginas:</label>
        <input type="number" class="form-control" id="num_paginas" name="num_paginas" required>
    </div>
    
    <div class="form-group mt-3">
        <label for="id_autor">Autor:</label>
        <select class="form-control" id="id_autor" name="id_autor" required>
            <option value="">Selecione um autor</option>
            <?php foreach ($authors as $author): ?>
            <option value="<?php echo $author['id']; ?>"><?php echo htmlspecialchars($author['nome']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group mt-3">
        <label for="id_genero">Gênero:</label>
        <select class="form-control" id="id_genero" name="id_genero" required>
            <option value="">Selecione um gênero</option>
            <?php foreach ($genres as $genre): ?>
            <option value="<?php echo $genre['id']; ?>"><?php echo htmlspecialchars($genre['nome']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
    <a href="listar.php" class="btn btn-secondary mt-3">Cancelar</a>
</form>

<?php
require_once '../../views/footer.php';
?>