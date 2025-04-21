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

<h2>Registrar Nova Leitura</h2>
<form action="../../controllers/ReadingController.php" method="post">
    <div class="form-group">
        <label for="id_livro">Livro:</label>
        <select class="form-control" id="id_livro" name="id_livro" required>
            <option value="">Selecione um livro</option>
            <?php foreach ($books as $book): ?>
            <option value="<?php echo $book['id']; ?>">
                <?php echo htmlspecialchars($book['titulo']); ?> (<?php echo htmlspecialchars($book['autor_nome']); ?>)
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="form-group mt-3">
        <label for="data_inicial">Data de Início:</label>
        <input type="date" class="form-control" id="data_inicial" name="data_inicial" required>
    </div>
    
    <div class="form-group mt-3">
        <label for="data_final">Data de Término:</label>
        <input type="date" class="form-control" id="data_final" name="data_final" required>
    </div>
    
    <div class="form-group mt-3">
        <label for="nota">Nota (1-10):</label>
        <select class="form-control" id="nota" name="nota" required>
            <option value="">Selecione uma nota</option>
            <option value="10">10 - Obra Prima</option>
            <option value="9">9 - Excelente</option>
            <option value="8">8 - Muito Bom</option>
            <option value="7">7 - Bom</option>
            <option value="6">6 - Ok</option>
            <option value="5">5 - Medíocre</option>
            <option value="4">4 - Ruim</option>
            <option value="3">3 - Muito Ruim</option>
            <option value="2">2 - Péssimo</option>
            <option value="1">1 - Intragável</option>
        </select>
    </div>
    
    <div class="form-group mt-3">
        <label for="comentario">Comentário:</label>
        <textarea class="form-control" id="comentario" name="comentario" rows="3"></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary mt-3">Registrar</button>
    <a href="listar.php" class="btn btn-secondary mt-3">Cancelar</a>
</form>

<?php
require_once '../../views/footer.php';
?>