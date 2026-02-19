document.addEventListener('DOMContentLoaded', () => {
    initDarkMode();
    initMobileMenu();
});

function initDarkMode() {
    
    const prefiereDarkMode = window.matchMedia('(prefers-color-sheme: dark)');

    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode');
    }else{
        document.body.classList.remove('dark-mode');
    }
    
    prefiereDarkMode.addEventListener('change', function() {
     if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode');
    }else{
        document.body.classList.remove('dark-mode');
    }   
    });

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
