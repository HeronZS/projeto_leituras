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

<h2>Livros</h2>
<a href="cadastrar.php" class="btn btn-success mb-3">Cadastrar Novo Livro</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Ano</th>
            <th>Páginas</th>
            <th>Autor</th>
            <th>Gênero</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($books as $book): ?>
        <tr>
            <td><?php echo $book['id']; ?></td>
            <td><?php echo htmlspecialchars($book['titulo']); ?></td>
            <td><?php echo $book['ano_publicacao']; ?></td>
            <td><?php echo $book['num_paginas']; ?></td>
            <td><?php echo htmlspecialchars($book['autor_nome']); ?></td>
            <td><?php echo htmlspecialchars($book['genero_nome']); ?></td>
            <td>
                <a href="editar.php?id=<?php echo $book['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="excluir.php?id=<?php echo $book['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
require_once '../../views/footer.php';
?>