<?php
require_once '../../views/header.php';
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="bi bi-person-plus me-2"></i>Cadastrar Novo Autor
                    </h3>
                </div>
                <div class="card-body">
                    <form action="../../controllers/AuthorController.php" method="post" id="authorForm">
                        <div class="mb-4">
                            <label for="nome" class="form-label fw-bold">Nome Completo</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person-vcard"></i>
                                </span>
                                <input type="text" class="form-control" id="nome" name="nome" 
                                       placeholder="Ex: Machado de Assis" required>
                            </div>
                            <div class="invalid-feedback">Por favor, insira o nome do autor.</div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="nacionalidade" class="form-label fw-bold">Nacionalidade</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-globe-americas"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" 
                                           placeholder="Ex: Brasileira" required>
                                </div>
                                <div class="invalid-feedback">Por favor, informe a nacionalidade.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="data_nascimento" class="form-label fw-bold">Data de Nascimento</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-calendar-date"></i>
                                    </span>
                                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento"
                                           max="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                                <div class="invalid-feedback">Selecione uma data válida.</div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="listar.php" class="btn btn-outline-secondary me-md-2">
                                <i class="bi bi-arrow-left"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Cadastrar Autor
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
    // Validação do formulário
    const form = document.getElementById('authorForm');
    const fields = form.querySelectorAll('[required]');
    
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        fields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        // Validação adicional para a data
        const dataNascimento = document.getElementById('data_nascimento');
        if (new Date(dataNascimento.value) > new Date()) {
            dataNascimento.classList.add('is-invalid');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            const firstInvalid = form.querySelector('.is-invalid');
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstInvalid.focus();
        }
    });
    
    // Validação em tempo real
    fields.forEach(field => {
        field.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });
    
    // Máscara para nacionalidade (permite apenas letras e espaços)
    const nacionalidade = document.getElementById('nacionalidade');
    nacionalidade.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');
    });
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
    #data_nascimento {
        position: relative;
    }
    #data_nascimento::-webkit-calendar-picker-indicator {
        position: absolute;
        right: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
</style>

<?php
require_once '../../views/footer.php';
?>