<?php
require_once '../../views/header.php';
?>

<h2>Cadastrar Novo Gênero</h2>
<form action="../../controllers/GenreController.php" method="post">
    <div class="form-group">
        <label for="nome">Nome do Gênero:</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    
    <button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
    <a href="listar.php" class="btn btn-secondary mt-3">Cancelar</a>
</form>

<?php
require_once '../../views/footer.php';
?>