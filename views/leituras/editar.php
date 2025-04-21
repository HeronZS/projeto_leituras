<?php
require_once '../../config/database.php';
require_once '../../models/Reading.php';
require_once '../../models/Book.php';
require_once '../../controllers/ReadingController.php';

$database = new Database();
$db = $database->connect();

$controller = new ReadingController();
$reading = $controller->getReading($_GET['id']);
$books = $controller->getAllBooks();

require_once '../../views/header.php';
?>

<h2>Editar Leitura</h2>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">Erro ao atualizar a leitura. Por favor, tente novamente.</div>
<?php endif; ?>

<form method="POST" action="../../controllers/ReadingController.php">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="id" value="<?php echo $reading['id']; ?>">

    <div class="form-group">
        <label for="id_livro">Livro</label>
        <select class="form-control" id="id_livro" name="id_livro" required>
            <?php foreach ($books as $book): ?>
                <option value="<?php echo $book['id']; ?>" <?php echo $book['id'] == $reading['id_livro'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($book['titulo']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="data_inicial">Data de Início</label>
        <input type="date" class="form-control" id="data_inicial" name="data_inicial" 
               value="<?php echo htmlspecialchars($reading['data_inicial']); ?>" required>
    </div>

    <div class="form-group">
        <label for="data_final">Data de Término</label>
        <input type="date" class="form-control" id="data_final" name="data_final" 
               value="<?php echo htmlspecialchars($reading['data_final']); ?>" required>
    </div>

    <div class="form-group">
        <label for="nota">Nota (1-10)</label>
        <input type="number" class="form-control" id="nota" name="nota" min="1" max="10" 
               value="<?php echo htmlspecialchars($reading['nota']); ?>" required>
    </div>

    <div class="form-group">
        <label for="comentario">Comentário</label>
        <textarea class="form-control" id="comentario" name="comentario" rows="3"><?php echo htmlspecialchars($reading['comentario']); ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="detalhes.php?id=<?php echo $reading['id']; ?>" class="btn btn-secondary">Cancelar</a>
</form>

<?php
require_once '../../views/footer.php';
?>