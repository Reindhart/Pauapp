$(document).ready(function() {
    $('#form-empleado').on('submit', function(e) {
        let vacio = false;
        $('#form-empleado input, #form-empleado select').each(function() {
            if ($(this).val().trim() === '') {
                vacio = true;
            }
        });
    
        $('#form-empleado input:not([type="file"]):not([type="hidden"]), #form-empleado select').each(function() {
            if ($(this).val().trim() === '') {
                vacio = true;
            }
        });
        
        // Validar que haya imagen (al menos una)
        const tieneDefault = $('#foto_default').val().trim() !== '';
        const tienePersonal = $('#foto_personal').val().trim() !== '';
        
        if (!tieneDefault && !tienePersonal) {
            vacio = true;
        }
    });
    
    $('#correo').on('blur', function() {
        const correo = $(this).val();
        if (correo.trim() === '') return;
    
        $.ajax({
            url: 'verificar_correo.php',
            method: 'POST',
            data: { correo },
            success: function(resp) {
                if (resp === 'existe') {
                    $('#correo-error').text(`El correo ${correo} ya existe.`);
                    setTimeout(() => $('#correo-error').text(''), 5000);
                    $('#correo').val('');
                }
            }
        });
    });

    $('#dropdown-trigger').on('click', function (e) {
        $('#dropdown-gallery').toggle();
        e.stopPropagation();
    });

    $(document).on('click', function () {
        $('#dropdown-gallery').hide();
    });

    // Selección de imagen predeterminada
    $('.img-option').on('click', function () {
        $('.img-option').css('border', '2px solid #ccc');
        $(this).css('border', '2px solid blue');

        const img = $(this).data('img');
        $('#foto_default').val(img);
        $('#dropdown-trigger').text(img ? `Seleccionado: ${img}` : 'Ninguna');
        $('#dropdown-gallery').hide();

        // Mostrar preview
        if (img) {
            $('#preview').attr('src', 'uploads/defaults/' + img).show();
        } else {
            $('#preview').attr('src', '').hide();
        }

        // Limpiar imagen personalizada
        $('#foto_personal').val('');
    });

    // Imagen personalizada
    $('#foto_personal').on('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (evt) {
                $('#preview').attr('src', evt.target.result).show();
            };
            reader.readAsDataURL(file);

            // Limpiar selección default
            $('#foto_default').val('');
            $('.img-option').css('border', '2px solid #ccc');
            $('#dropdown-trigger').text('Seleccionar imagen predeterminada');
        }
    });
});
