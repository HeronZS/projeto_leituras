<?php
require_once '../../views/header.php';
?>

<h2>Cadastrar Novo Autor</h2>
<form action="../../controllers/AuthorController.php" method="post">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    
    <div class="form-group mt-3">
        <label for="nacionalidade">Nacionalidade:</label>
        <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" required>
    </div>
    
    <div class="form-group mt-3">
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
    </div>
    
    <button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
    <a href="listar.php" class="btn btn-secondary mt-3">Cancelar</a>
</form>

<?php
require_once '../../views/footer.php';
?>