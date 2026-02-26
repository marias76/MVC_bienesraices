document.addEventListener('DOMContentLoaded', () => {
    initDarkMode();
    initMobileMenu();
    eventListeners();
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
function eventListeners() {
    document.addEventListener('change', function(event) {
        if(event.target.matches('input[name="contacto[contacto]"]')) {
            mostrarMetodosContacto(event);
        }
    });

}
function mostrarMetodosContacto(event) {
    const contactoDiv = document.querySelector('#contacto');
    if(event.target.value === 'telefono') {
        contactoDiv.innerHTML = `        
        <p><span>Ingrese su Teléfono: </span></p>
        <input type="tel" id="telefono" name="contacto[telefono]" placeholder="Tu Teléfono" required>

        <p><span>Elija la fecha y la Hora para la llamada:</span></p>
            <div id="contacto-telefono" class="contacto-informacion">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="contacto[fecha]" required>
                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="contacto[hora]" min="09:00" max="18:00" required>
            </div>`;
    }
    else if(event.target.value === 'email') {
        contactoDiv.innerHTML = `
        <p><span>Ingrese su E-mail: </span></p>
        <div id="contacto-email" class="contacto-informacion">
                <label for="email-preferencia">E-mail:</label>
                <input type="email" id="email-preferencia" name="contacto[email-preferencia]" placeholder="Tu E-mail" required>
        </div>`;
    }

}