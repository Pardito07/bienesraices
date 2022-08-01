const errores = document.querySelectorAll('.alerta');

if(errores){
    errores.forEach( error => {
        setTimeout(() => {
            error.remove();
        }, 5000);
    });
}