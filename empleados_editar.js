$(document).ready(function () {
    $('#dropdown-trigger').on('click', function (e) {
        $('#dropdown-gallery').toggle();
        e.stopPropagation();
    });

    $(document).on('click', function () {
        $('#dropdown-gallery').hide();
    });

    $('.img-option').on('click', function () {
        $('.img-option').css('border', '2px solid #ccc');
        $(this).css('border', '2px solid blue');

        const img = $(this).data('img');
        $('#foto_default').val(img);
        $('#dropdown-trigger').text(img ? `Seleccionado: ${img}` : 'Ninguna');
        $('#dropdown-gallery').hide();

        if (img) {
            $('#preview').attr('src', 'uploads/defaults/' + img).show();
        } else {
            $('#preview').attr('src', 'uploads/defaults/no2-0.png').show();
        }

        $('#foto_personal').val('');
    });

    $('#foto_personal').on('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (evt) {
                $('#preview').attr('src', evt.target.result).show();
            };
            reader.readAsDataURL(file);

            $('#foto_default').val('');
            $('.img-option').css('border', '2px solid #ccc');
            $('#dropdown-trigger').text('Seleccionar nueva imagen predeterminada');
        }
    });

    const idActual = $('#form-edit input[name="id"]').val();
    $('#correo').on('blur', function () {
        const correo = $(this).val();
        if (correo.trim() === '') return;

        $.ajax({
            url: 'verificar_correo.php',
            method: 'POST',
            data: { correo: correo, excluir_id: idActual },
            success: function (resp) {
                if (resp === 'existe') {
                    $('#correo-error').text(`El correo ${correo} ya existe.`);
                    setTimeout(() => $('#correo-error').text(''), 5000);
                    $('#correo').val('');
                }
            }
        });
    });

    $('#form-edit').on('submit', function(e) {
        let error = false;
        $('#form-edit input[name=nombre], #form-edit input[name=apellidos], #form-edit input[name=correo], #form-edit select[name=rol]').each(function() {
            if ($(this).val().trim() === '') {
                error = true;
            }
        });
    
        if (error) {
            e.preventDefault();
            $('#form-error').text('Faltan campos por llenar.');
            setTimeout(() => $('#form-error').text(''), 5000);
        }
    });
});