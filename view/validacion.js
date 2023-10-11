function validar(){
    const nombre = document.getElementById('nombre');
    const contrasena = document.getElementById('contrasena');
    const email = document.getElementById('email');
    const r_contrasena = document.getElementById('r_contrasena');
    const error = document.getElementById('error');

    if(nombre.value == ""){
        error.innerHTML = "Error usuario vacio";
        return false;
    }

    if(email != undefined){
        if(email.value == ""){
            error.innerHTML = "Error email vacio";
            return false;
        }
    }
    
    if(contrasena.value == ""){
        error.innerHTML = "Error contraseña vacia";
        return false;
    }

    if(contrasena.value.length < 8){
        error.innerHTML = "Error la contraseña tiene que tener mas de 8 caracteres";
        return false;
    }

    
    debugger
    if(r_contrasena != undefined){
        if(r_contrasena.value == ""){
            error.innerHTML = "Error repetir contraseña vacia";
            return false;
        }

        if(contrasena.value != r_contrasena.value){
            error.innerHTML = "Error la contraseñas no coinciden";
            return false;
        }
    }

    return true;
}
