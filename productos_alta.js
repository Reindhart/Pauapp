$(document).ready(function() {

    parseFloat($('#costo').val()).toFixed(2)

    $('#form-producto').on('submit', function(e) {
        let vacio = false;
        $('#form-producto input').each(function() {
            if ($(this).val().trim() === '') {
                vacio = true;
            }
        });
        
        
        const precioNum = parseFloat($(this).val()).toFixed(2);
        if (isNaN(precioNum) || precioNum <= 0) {
            vacio = true;
            $('#costo').val('');
            alert('El costo debe ser un número positivo.');
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
