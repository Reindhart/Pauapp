$(document).ready(function () {
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
                console.log(respuesta);
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