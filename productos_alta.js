$(document).ready(function() {

    function generarCodigoUnico() {
        function intentarCodigo() {
            const codigo = Math.floor(Math.random() * 100000).toString().padStart(5, '0');

            $.ajax({
                url: 'verificar_codigo.php',
                method: 'POST',
                data: { codigo },
                success: function(resp) {
                    if (resp === 'disponible') {
                        $('#codigo').val(codigo);
                    } else {
                        intentarCodigo(); // Intenta con otro código si ya existe
                    }
                },
                error: function() {
                    console.error("Error al verificar el código.");
                }
            });
        }

        intentarCodigo();
    }

    generarCodigoUnico();

    $('#costo').on('blur', function () {
        let valor = parseFloat($(this).val());
        if (!isNaN(valor)) {
            $(this).val(valor.toFixed(2));
        } else {
            $(this).val('');
        }
    });

    $('#codigo').on('input', function () {
        let val = $(this).val();
        if (!/^\d+$/.test(val)) {
            $(this).val(val.replace(/\D/g, ''));
        }
    });

    $('#stock').on('input', function () {
        let val = $(this).val();
        if (!/^\d+$/.test(val)) {
            $(this).val(val.replace(/\D/g, ''));
        }
    });

    $('#form-producto').on('submit', function(e) {
        let vacio = false;
        $('#form-producto input').each(function() {
            if ($(this).val().trim() === '') {
                vacio = true;
            }
        });
        
        let errores = [];

        let costo = parseFloat($('#costo').val());
        if (isNaN(costo) || costo < 0) {
            errores.push('El costo debe ser un número positivo.');
        } else {
            $('#costo').val(costo.toFixed(2));
        }

        let codigo = $('#codigo').val();
        if (!/^\d+$/.test(codigo)) {
            errores.push('El código debe ser un número entero positivo.');
        }

        let stock = $('#stock').val();
        if (!/^\d+$/.test(stock)) {
            errores.push('El stock debe ser un número entero positivo.');
        }

        if (errores.length > 0) {
            e.preventDefault();
            $('#form-error').html(errores.join('<br>'));
        }

        $('#form-producto input:not([type="file"]):not([type="hidden"])').each(function() {
            if ($(this).val().trim() === '') {
                vacio = true;
            }
        });
        
        const tieneImagen = $('#imagen_producto').val().trim() !== '';
        if (!tieneImagen) {
            vacio = true;
        }
    });
    
    $('#codigo').on('blur', function() {
        const codigo = $(this).val();
        if (codigo.trim() === '') return;

        $.ajax({
            url: 'verificar_codigo.php',
            method: 'POST',
            data: { codigo },
            success: function(resp) {
                if (resp === 'existe') {
                    $('#codigo-error').text(`El código ${codigo} ya existe.`);
                    setTimeout(() => $('#codigo-error').text(''), 5000);
                    $('#codigo').val('');
                }
            }
        });
    });

    $('#imagen_producto').on('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (evt) {
                $('#preview').attr('src', evt.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });
});
