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

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="bi bi-journal-bookmark me-2"></i>Registrar Nova Leitura
                    </h3>
                </div>
                <div class="card-body">
                    <form action="../../controllers/ReadingController.php" method="post" id="readingForm">
                        <!-- Campo Livro -->
                        <div class="mb-4">
                            <label for="id_livro" class="form-label fw-bold">Livro Lido</label>
                            <select class="form-select" id="id_livro" name="id_livro" required>
                                <option value="" selected disabled>Selecione um livro...</option>
                                <?php foreach ($books as $book): ?>
                                <option value="<?php echo $book['id']; ?>">
                                    <?php echo htmlspecialchars($book['titulo']); ?> 
                                    <small class="text-muted">- <?php echo htmlspecialchars($book['autor_nome']); ?></small>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Por favor, selecione um livro.</div>
                            <small class="text-muted mt-1 d-block">
                                Não encontrou o livro? <a href="../livros/cadastrar.php">Cadastre um novo</a>
                            </small>
                        </div>

                        <!-- Datas de Leitura -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="data_inicial" class="form-label fw-bold">Data de Início</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-calendar-start"></i>
                                    </span>
                                    <input type="date" class="form-control" id="data_inicial" name="data_inicial" 
                                           max="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                                <div class="invalid-feedback">Selecione uma data válida.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="data_final" class="form-label fw-bold">Data de Término</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-calendar-check"></i>
                                    </span>
                                    <input type="date" class="form-control" id="data_final" name="data_final" 
                                           max="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                                <div class="invalid-feedback">Selecione uma data válida.</div>
                            </div>
                        </div>

                        <!-- Sistema de Avaliação -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Avaliação do Livro</label>
                            <div class="star-rating">
                                <input type="radio" id="star1" name="nota" value="1">
                                <label for="star1" title="1 - Intragável">★</label>
                                
                                <input type="radio" id="star2" name="nota" value="2">
                                <label for="star2" title="2 - Péssimo">★</label>
                                
                                <input type="radio" id="star3" name="nota" value="3">
                                <label for="star3" title="3 - Muito Ruim">★</label>
                                
                                <input type="radio" id="star4" name="nota" value="4">
                                <label for="star4" title="4 - Ruim">★</label>

                                <input type="radio" id="star5" name="nota" value="5">
                                <label for="star5" title="5 - Medíocre">★</label>
                                
                                <input type="radio" id="star6" name="nota" value="6">
                                <label for="star6" title="6 - Ok">★</label>
                                
                                <input type="radio" id="star7" name="nota" value="7">
                                <label for="star7" title="7 - Bom">★</label>
                                
                                <input type="radio" id="star8" name="nota" value="8">
                                <label for="star8" title="8 - Muito Bom">★</label>
                                
                                <input type="radio" id="star9" name="nota" value="9">
                                <label for="star9" title="9 - Excelente">★</label>
                                
                                <input type="radio" id="star10" name="nota" value="10" required>
                                <label for="star10" title="10 - Obra Prima">★</label>
                            </div>
                            <div class="invalid-feedback">Por favor, avalie o livro.</div>
                            <small class="text-muted">Clique na estrela correspondente à sua avaliação</small>
                        </div>

                        <div class="mb-4">
                            <label for="comentario" class="form-label fw-bold">Comentários</label>
                            <textarea class="form-control" id="comentario" name="comentario" rows="4" 
                                      placeholder="O que achou do livro? Foi impactante? Recomendaria?"></textarea>
                            <small class="text-muted">(Opcional)</small>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="listar.php" class="btn btn-outline-secondary me-md-2">
                                <i class="bi bi-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-journal-check"></i> Registrar Leitura
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
    const form = document.getElementById('readingForm');
    const dataInicial = document.getElementById('data_inicial');
    const dataFinal = document.getElementById('data_final');
    
    form.addEventListener('submit', function(e) {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (new Date(dataFinal.value) < new Date(dataInicial.value)) {
            dataFinal.classList.add('is-invalid');
            dataFinal.nextElementSibling.textContent = 'A data final deve ser posterior à data inicial';
            isValid = false;
        }
        
        const notaSelecionada = form.querySelector('input[name="nota"]:checked');
        if (!notaSelecionada) {
            const starContainer = form.querySelector('.star-rating');
            starContainer.nextElementSibling.style.display = 'block';
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            const firstInvalid = form.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalid.focus();
            }
        }
    });
    
    [dataInicial, dataFinal].forEach(field => {
        field.addEventListener('change', function() {
            if (this.value) {
                this.classList.remove('is-invalid');
                
                if (dataInicial.value && dataFinal.value) {
                    if (new Date(dataFinal.value) >= new Date(dataInicial.value)) {
                        dataFinal.classList.remove('is-invalid');
                    }
                }
            }
        });
    });
    
    // Sistema de estrelas melhorado
    const starInputs = document.querySelectorAll('.star-rating input');
    const starLabels = document.querySelectorAll('.star-rating label');
    
    // Função para colorir as estrelas baseada na avaliação
    function colorStars(rating) {
        starLabels.forEach((label, index) => {
            if (index < rating) {
                label.style.color = 'gold';
            } else {
                label.style.color = '#dee2e6';
            }
        });
    }
    
    // Função para resetar todas as estrelas
    function resetStars() {
        const checkedInput = document.querySelector('.star-rating input:checked');
        if (checkedInput) {
            colorStars(parseInt(checkedInput.value));
        } else {
            starLabels.forEach(label => {
                label.style.color = '#dee2e6';
            });
        }
    }
    
    // Eventos de hover para cada estrela
    starLabels.forEach((label, index) => {
        label.addEventListener('mouseover', function() {
            colorStars(index + 1);
        });
        
        label.addEventListener('mouseout', function() {
            resetStars();
        });
    });
    
    // Evento de clique nas estrelas
    starInputs.forEach((input, index) => {
        input.addEventListener('change', function() {
            colorStars(parseInt(this.value));
        });
    });
    
    document.getElementById('id_livro').focus();
});
</script>

<style>
    .form-control, .form-select, textarea {
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
    .star-rating {
        display: flex;
        gap: 5px;
        font-size: 2rem;
        line-height: 1;
    }
    .star-rating input {
        display: none;
    }
    .star-rating label {
        color: #dee2e6;
        cursor: pointer;
        transition: color 0.2s;
        user-select: none;
    }
    .star-rating label:hover {
        color: gold;
    }
</style>

<?php
require_once '../../views/footer.php';
?>