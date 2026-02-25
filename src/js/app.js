document.addEventListener('DOMContentLoaded', () => {
    initDarkMode();
    initMobileMenu();
});

function initDarkMode() {
    
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode');
    }else{
        document.body.classList.remove('dark-mode');
    }
    
    const cambiarModo = function() {
        if(prefiereDarkMode.matches){
            document.body.classList.add('dark-mode');
        }else{
            document.body.classList.remove('dark-mode');
        }
    };

    if(prefiereDarkMode.addEventListener) {
        prefiereDarkMode.addEventListener('change', cambiarModo);
    } else {
        prefiereDarkMode.addListener(cambiarModo);
    }

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    if (botonDarkMode) {
        botonDarkMode.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
        });
    }
}

function initMobileMenu() {
    const mobileMenu = document.querySelector('.mobile-menu');
    const navegacion = document.querySelector('.navegacion');
    if (mobileMenu && navegacion) {
        mobileMenu.addEventListener('click', () => {
            navegacion.classList.toggle('mostrar');
        });
    }
}
