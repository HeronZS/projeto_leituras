<?php
require_once '../../config/database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

$author = new Author($db);
$result = $author->read();
$authors = $result->fetchAll(PDO::FETCH_ASSOC);

require_once '../../views/header.php';
?>

<h2>Autores</h2>
<a href="cadastrar.php" class="btn btn-success mb-3">Cadastrar Novo Autor</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Nacionalidade</th>
            <th>Data de Nascimento</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($authors as $author): ?>
        <tr>
            <td><?php echo $author['id']; ?></td>
            <td><?php echo htmlspecialchars($author['nome']); ?></td>
            <td><?php echo htmlspecialchars($author['nacionalidade']); ?></td>
            <td><?php echo date('d/m/Y', strtotime($author['data_nascimento'])); ?></td>
            <td>
                <a href="editar.php?id=<?php echo $author['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="excluir.php?id=<?php echo $author['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este autor?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
require_once '../../views/footer.php';
?>