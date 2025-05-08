document.addEventListener('DOMContentLoaded', function () {
    // Elementos del formulario
    const form = document.getElementById('contactForm');
    const deseoSelect = document.getElementById('deseo');
    const deseoInformacionDiv = document.getElementById('deseo-informacion');
    const informacionSelect = document.getElementById('informacion');
    const politicaCheckbox = document.getElementById('politicaCheckbox');
    const recibirInfoRadios = document.querySelectorAll('input[name="recibir_info"]');
    const enviarButton = document.getElementById('enviarButton');
    let validar=document.getElementById("validar");
    // 1. Mostrar/ocultar campo "Deseo información de" (funcionalidad que ya tenías)
    deseoSelect.addEventListener('change', function() {
        if (this.value === 'Información sobre un servicio') {
            deseoInformacionDiv.style.display = 'block';
            informacionSelect.setAttribute('required', 'required');
        } else {
            deseoInformacionDiv.style.display = 'none';
            informacionSelect.removeAttribute('required');
            informacionSelect.value = '';
        }
        checkFormValidity(); // Verificar si el formulario es válido
    });

    // 2. Validar el formulario antes de enviar (nuevo)
    form.addEventListener('submit', function(e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            alert('Por favor complete todos los campos obligatorios correctamente.');
        }
    });

    // // 3. Función para habilitar/deshabilitar el botón (nuevo)
    // function checkFormValidity() {
    //     const isFormValid = form.checkValidity();
    //     enviarButton.disabled = !isFormValid;

    //     // Cambiar estilo del botón (opcional, si quieres feedback visual)
    //     if (enviarButton.disabled) {
    //         enviarButton.style.opacity = '0.5';
    //         enviarButton.style.cursor = 'not-allowed';
    //     } else {
    //         enviarButton.style.opacity = '1';
    //         enviarButton.style.cursor = 'pointer';
    //     }
    // }

    // 4. Escuchar cambios en todos los campos requeridos (nuevo)
    form.querySelectorAll('[required]').forEach(element => {
        element.addEventListener('change', checkFormValidity);
        element.addEventListener('input', checkFormValidity); // Para validar en tiempo real
    });

    // 5. Validar radio buttons "Deseo recibir información" (nuevo)
    // recibirInfoRadios.forEach(radio => {
    //     radio.addEventListener('change', checkFormValidity);
    // });

    // 6. Validar checkbox de políticas (nuevo)
    politicaCheckbox.addEventListener('change', checkFormValidity);

    // Validar inicialmente al cargar la página
    checkFormValidity();
    });

    function comprobar (){

    if(validar == 1){
        console.log("El valor es 1")
    }
    else {
        console.log("El valor es cero")
    };

}