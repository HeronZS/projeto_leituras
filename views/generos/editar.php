<?php
require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../../models/Genre.php');
require_once (__DIR__ . '/../../controllers/GenreController.php');

$database = new Database();
$db = $database->connect();

$controller = new GenreController();
$genre = $controller->getGenre($_GET['id']);

require_once (__DIR__ . '/../../views/header.php');
?>

<h2>Editar Gênero</h2>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">Erro ao atualizar o gênero. Por favor, tente novamente.</div>
<?php endif; ?>

<form method="POST" action="../../controllers/GenreController.php">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="id" value="<?php echo $genre['id']; ?>">

    <div class="form-group">
        <label for="nome">Nome do Gênero</label>
        <input type="text" class="form-control" id="nome" name="nome" 
               value="<?php echo htmlspecialchars($genre['nome']); ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="listar.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php
require_once (__DIR__ . '/../../views/footer.php');
?>