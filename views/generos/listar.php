<?php
require_once '../../config/database.php';
require_once '../../models/Genre.php';

$database = new Database();
$db = $database->connect();

$genre = new Genre($db);
$result = $genre->read();
$genres = $result->fetchAll(PDO::FETCH_ASSOC);

require_once '../../views/header.php';
?>

<h2>Gêneros Literários</h2>
<a href="cadastrar.php" class="btn btn-success mb-3">Cadastrar Novo Gênero</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($genres as $genre): ?>
        <tr>
            <td><?php echo $genre['id']; ?></td>
            <td><?php echo htmlspecialchars($genre['nome']); ?></td>
            <td>
                <a href="editar.php?id=<?php echo $genre['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="excluir.php?id=<?php echo $genre['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este gênero?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
require_once '../../views/footer.php';
?>