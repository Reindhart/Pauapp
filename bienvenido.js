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
    sessionStorage.removeItem('bienvenida_mostrada');
    document.getElementById('logout-form').submit();
}
