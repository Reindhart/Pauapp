$(document).ready(function () {

    if ($('#mensaje_sesion').text().trim() !== '') {
            setTimeout(() => {
                $('#mensaje_sesion').fadeOut();
            }, 3000);
        }

    $('.dismiss').on('click', function () {
        console.log("boton")
        $(this).closest('.aesthetic-windows-xp-notification').removeClass('is-active');
    });

    $('#form-login').on('submit', function (e) {
        e.preventDefault();
        
        const correo = $('#correo').val().trim();
        const pass = $('#pass').val().trim();

        if (correo === '' || pass === '') {
            $('#mensaje').text('Todos los campos son obligatorios.');
            setTimeout(() => $('#mensaje').text(''), 5000);
            return;
        }

        $.ajax({
            url: 'verificar_login.php',
            method: 'POST',
            data: { correo, pass },
            success: function (respuesta) {
                if (respuesta === 'ok') {
                    window.location.href = 'bienvenido.php';
                } else {
                    $('#mensaje').text('Correo o contraseña incorrectos.');
                }
                setTimeout(() => $('#mensaje').text(''), 5000);
            },
            error: function () {
                $('#mensaje').text('Error en la petición.');
                setTimeout(() => $('#mensaje').text(''), 5000);
            }
        });
    });
});