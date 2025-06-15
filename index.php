<?php
require_once 'views/header.php';
?>

<main class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-primary">Boas Leituras</h1>
        <p class="lead text-muted">Gerencie sua biblioteca pessoal e registre suas aventuras literárias</p>
    </div>

    <div class="row mt-4 g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card h-100 card-home shadow-sm">
                <div class="card-body text-center d-flex flex-column">
                    <div class="my-3">
                        <i class="bi bi-person-badge fs-1 text-primary" 
                           data-bs-toggle="tooltip" 
                           title="Cadastre autores como Machado de Assis ou J.K. Rowling"></i>
                    </div>
                    <h3 class="h5 card-title mb-3">Autores</h3>
                    <p class="card-text text-muted mb-4">Cadastre e consulte os autores dos seus livros</p>
                    <div class="mt-auto">
                        <a href="views/autores/listar.php" class="btn btn-access btn-lg p-3">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 card-home shadow-sm">
                <div class="card-body text-center d-flex flex-column">
                    <div class="my-3">
                        <i class="bi bi-tags fs-1 text-info" 
                           data-bs-toggle="tooltip" 
                           title="Organize por gêneros como Fantasia, Ficção Científica, etc."></i>
                    </div>
                    <h3 class="h5 card-title mb-3">Gêneros</h3>
                    <p class="card-text text-muted mb-4">Classifique seus livros por categorias</p>
                    <div class="mt-auto">
                        <a href="views/generos/listar.php" class="btn btn-access btn-lg p-3">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 card-home shadow-sm">
                <div class="card-body text-center d-flex flex-column">
                    <div class="my-3">
                        <i class="bi bi-book fs-1 text-warning" 
                           data-bs-toggle="tooltip" 
                           title="Registre todos os livros da sua coleção"></i>
                    </div>
                    <h3 class="h5 card-title mb-3">Livros</h3>
                    <p class="card-text text-muted mb-4">Sua biblioteca pessoal organizada</p>
                    <div class="mt-auto">
                        <a href="views/livros/listar.php" class="btn btn-access btn-lg p-3">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100 card-home shadow-sm">
                <div class="card-body text-center d-flex flex-column">
                    <div class="my-3">
                        <i class="bi bi-bookmark-check fs-1 text-success" 
                           data-bs-toggle="tooltip" 
                           title="Registre quando leu e avalie cada livro"></i>
                    </div>
                    <h3 class="h5 card-title mb-3">Leituras</h3>
                    <p class="card-text text-muted mb-4">Seu histórico e avaliações</p>
                    <div class="mt-auto">
                        <a href="views/leituras/listar.php" class="btn btn-access btn-lg p-3">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 pt-4 border-top">
        <div class="col-12 text-center">
            <h2 class="h4 text-muted mb-4">Explore seu mundo literário</h2>
            <div class="d-flex justify-content-center gap-4 flex-wrap">
                <div class="stat-circle">
                    <div class="fs-3 fw-bold text-primary">+100</div>
                    <small class="text-muted">Livros</small>
                </div>
                <div class="stat-circle">
                    <div class="fs-3 fw-bold text-success">4.8</div>
                    <small class="text-muted">Média de notas</small>
                </div>
                <div class="stat-circle">
                    <div class="fs-3 fw-bold text-info">15</div>
                    <small class="text-muted">Autores</small>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once 'views/footer.php';
?>