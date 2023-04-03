$(document).ready(() => {

    $('.txtPhone').mask('000-000-0000', { placeholder : '___-___-____'});

    //Masque poue la BETA KEY
    $('.txtBetaKey').mask('A00000-ZZZZ-ZZZZ-ZZZZ-E', {   
            placeholder:'_____-____-____-____-_', 
            translation: { A: { pattern:/[YyKk]/ }, 
                           Z: { pattern:/[a-zA-Z0-9]/ }, 
                           E: { pattern:/[AaBb]/} 
            } 
        });

    $('.txtBetaKey').keyup(function () {
        $(this).val($(this).val().toUpperCase());
    });

    const registrationForm = document.querySelectorAll('.needs-validation-register');

    addValidationToForm(registrationForm);

});

function addValidationToForm(forms) {
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
    });
}