<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Author.php';
require_once __DIR__ . '/../../controllers/AuthorController.php';

$database = new Database();
$db = $database->connect();

$controller = new AuthorController();
$author = $controller->getAuthor($_GET['id']);

require_once __DIR__ . '/../../views/header.php';
?>

<h2>Editar Autor</h2>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">Erro ao atualizar o autor. Por favor, tente novamente.</div>
<?php endif; ?>

<form method="POST" action="/projeto_leituras/controllers/AuthorController.php">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="id" value="<?php echo $author['id']; ?>">

    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" 
               value="<?php echo htmlspecialchars($author['nome']); ?>" required>
    </div>

    <div class="form-group">
        <label for="nacionalidade">Nacionalidade</label>
        <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" 
               value="<?php echo htmlspecialchars($author['nacionalidade']); ?>">
    </div>

    <div class="form-group">
        <label for="data_nascimento">Data de Nascimento</label>
        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" 
               value="<?php echo htmlspecialchars($author['data_nascimento']); ?>">
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="listar.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php
require_once __DIR__ . '/../../views/footer.php';
?>