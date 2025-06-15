<?php
require_once '../../views/header.php';
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="bi bi-tag me-2"></i>Cadastrar Novo Gênero Literário
                    </h3>
                </div>
                <div class="card-body">
                    <form action="../../controllers/GenreController.php" method="post" id="genreForm">
                        <div class="mb-4">
                            <label for="nome" class="form-label fw-bold">Nome do Gênero</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-tag-fill"></i>
                                </span>
                                <input type="text" class="form-control" id="nome" name="nome" 
                                       placeholder="Ex: Ficção Científica, Romance, Terror..." 
                                       pattern="[A-Za-zÀ-ÿ\s]{3,}" 
                                       title="O nome deve conter apenas letras e ter pelo menos 3 caracteres"
                                       required>
                            </div>
                            <div class="invalid-feedback">
                                Por favor, insira um nome válido (mínimo 3 caracteres, apenas letras e espaços)
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="listar.php" class="btn btn-outline-secondary me-md-2">
                                <i class="bi bi-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Cadastrar Gênero
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('genreForm');
    const nomeInput = document.getElementById('nome');
    
    form.addEventListener('submit', function(e) {
        if (!nomeInput.value.trim() || !nomeInput.checkValidity()) {
            e.preventDefault();
            nomeInput.classList.add('is-invalid');
            nomeInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
            nomeInput.focus();
        }
    });
    
    nomeInput.addEventListener('input', function() {
        if (this.value.trim() && this.checkValidity()) {
            this.classList.remove('is-invalid');
        } else {
            this.classList.add('is-invalid');
        }
        
        if (this.value.length > 1) {
            this.value = this.value.toLowerCase().replace(/(?:^|\s)\S/g, function(a) {
                return a.toUpperCase();
            });
        }
    });
    
    nomeInput.focus();
});
</script>

<style>
    .form-control {
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
    }
    .input-group-text {
        background-color: #f8f9fa;
    }
    .card {
        border-radius: 0.5rem;
    }
    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }
    #nome {
        text-transform: capitalize;
    }
</style>

<?php
require_once '../../views/footer.php';
?>