document.addEventListener('DOMContentLoaded', function(){
    eventListeners();
    darkMode();
});

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);

    metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');

    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodoContacto));
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}

function mostrarMetodoContacto(e){
    
    const contactoDiv = document.querySelector('#contacto');

    if(e.target.value === 'telefono'){

        contactoDiv.innerHTML = `
            <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]">

            <p>Elija fecha y hora para la llamada</p>

            <label for="fecha">Fecha</label>
            <input data-cy="input-fecha" type="date" id="fecha" name="contacto[fecha]">
            <label data-cy="input-hora" for="hora">Hora</label>
            <input type="time" id="hora" name="contacto[hora]">
        `;
    }else {
        contactoDiv.innerHTML = `
            <input data-cy="input-email" type="email" placeholder="Tu Email" id="email" name="contacto[email]" required>
        `;
    }
}

function darkMode(){
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode');
    }else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function(){
        if(prefiereDarkMode.matches){
            document.body.classList.add('dark-mode');
        }else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');
    });
}