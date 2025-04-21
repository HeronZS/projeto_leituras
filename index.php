<?php
require_once 'views/header.php';
?>

<h1 class="text-center">Boas Leituras</h1>
<p class="text-center">Gerencie sua biblioteca pessoal e registre suas leituras e livros favoritos</p>

<div class="row mt-5">
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h5 class="card-title">Autores</h5>
                <p class="card-text">Cadastre e consulte os autores</p>
                <a href="views/autores/listar.php" class="btn btn-primary">Acessar</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h5 class="card-title">Gêneros</h5>
                <p class="card-text">Gerencie os gêneros literários</p>
                <a href="views/generos/listar.php" class="btn btn-primary">Acessar</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h5 class="card-title">Livros</h5>
                <p class="card-text">Cadastre os livros da sua biblioteca</p>
                <a href="views/livros/listar.php" class="btn btn-primary">Acessar</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <h5 class="card-title">Leituras</h5>
                <p class="card-text">Registre suas leituras e avaliações</p>
                <a href="views/leituras/listar.php" class="btn btn-primary">Acessar</a>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'views/footer.php';
?>