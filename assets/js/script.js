document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                const firstInvalid = form.querySelector('.is-invalid');
                firstInvalid.focus();
            } else {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) submitBtn.classList.add('btn-loading');
            }
        });
    });

    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (el) {
        return new bootstrap.Tooltip(el);
    });

    document.querySelectorAll('.star-rating').forEach(rating => {
        const stars = rating.querySelectorAll('.star');
        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                stars.forEach((s, i) => {
                    s.classList.toggle('text-warning', i <= index);
                });
                const input = rating.parentElement.querySelector('input[name="nota"]');
                if (input) input.value = index + 1;
            });
        });
    });

    if (document.querySelector('.card-home')) {
        document.querySelectorAll('.card-home').forEach(card => {
            card.style.opacity = '0';
        });
    }
});
