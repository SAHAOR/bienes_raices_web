document.addEventListener('DOMContentLoaded', function(){
    eventListeners();
    darkMode();
});

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive)

    //muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));
 
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');
    // if(navegacion.classList.contains('mostrar')){
    //     navegacion.classList.remove('mostrar');

    // }
    // else{
    //     navegacion.classList.add('mostrar');
    // }

    navegacion.classList.toggle('mostrar');
}

function darkMode(){
    const prefiereDarkMode= window.matchMedia('(prefers-color-scheme: dark)');
    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode');
    }
    else{
        document.body.classList.remove('dark-mode');
    }
    prefiereDarkMode.addEventListener('change', function(){
        if(prefiereDarkMode.matches){
            document.body.classList.add('dark-mode');
        }
        else{
            document.body.classList.remove('dark-mode');
        }
    })
    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');
    });
}

function mostrarMetodosContacto(e){
    const contactoDiv = document.querySelector('#contacto');

    if(e.target.value === 'telefono'){
        contactoDiv.innerHTML = `
        
        <label for="telefono">Numero telefono</label>
        <input type="tel" placeholder="Ejemplo: 123456679" id="telefono" name="contacto[telefono]" required>

        <p>Elija la fecha y hora para ser contactado</p>

        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora</label>
        <input type="time" id="hora" min="09:00" max="16:00" name="contacto[hora]">
        `;
    }
    else{
        contactoDiv.innerHTML = `
        
        <label for="email">E-mail</label>
        <input type="email" placeholder="Ejemplo: pepe@correo.com" id="email" name="contacto[email]" required>

        `;
    }
}