document.addEventListener('DOMContentLoaded', function () {
    const bienvenida = document.getElementById('pantalla-bienvenida');
    const escritorio = document.getElementById('escritorio');

    if (!sessionStorage.getItem('bienvenida_mostrada')) {
        bienvenida.style.display = 'flex';
        bienvenida.style.opacity = '1';

        const audio = new Audio('startup-computer.mp3');
        audio.play();
        
        setTimeout(() => {
            bienvenida.style.display = 'none';
            sessionStorage.setItem('bienvenida_mostrada', '1');
        }, 3000);
    } else {
        bienvenida.style.display = 'none';
    }
    
});

function cerrarSesion() {
    const audio = new Audio('logoff-computer.mp3');
    audio.play();
    console.log("Cerrando sesión...")

    document.body.classList.add('fadeout');
    sessionStorage.removeItem('bienvenida_mostrada');

    setTimeout(() => {
        document.getElementById('logout-form').submit();
    }, 1000);
}

