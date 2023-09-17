window.onload = init
// https://stackoverflow.com/q/8935632 comprobar números
// https://stackoverflow.com/q/9862761 comprobar letras
function init() {
    var boton = document.getElementById("botonRegistro")
    boton.addEventListener("click", () => {
        event.preventDefault();
        var aceptado = true
        var nombre = document.getElementsByName("nombre")[0]?.value
        var telefono = document.getElementsByName("telefono")[0]?.value
        var dni = document.getElementsByName("dni")[0]?.value
        var email = document.getElementsByName("email")[0]?.value
        var nacimiento = document.getElementsByName("nacimiento")[0]?.value
        var usuario = document.getElementsByName("usuario")[0]?.value
        var passwd = document.getElementsByName("passwd")[0]?.value

        aceptado = aceptado && comprobarNombre(nombre)
        console.log("Nombre", aceptado)

        aceptado = aceptado && comprobarTelefono(telefono)
        console.log("Telefono", aceptado)

        aceptado = aceptado && validarDNI(dni)
        console.log("DNI", aceptado)

        aceptado = aceptado && comprobarEmail(email)
        console.log("Email", aceptado)

        aceptado = aceptado && comprobarNacimiento(nacimiento)
        console.log("Nacimiento", aceptado)

        aceptado = aceptado && comprobarUsuario(usuario)
        console.log("Aceptado", aceptado)
        // comprobarPasswd(aceptado, passwd)
        
        console.log(aceptado)
        if(aceptado){
            var form = document.getElementById("form-registro")
            form.submit()
        }
    })
}

function comprobarTelefono(telefono){
    // 9 números
    var aceptado = true
    for(const char of telefono){
        aceptado = aceptado && char >= '0' && char <= '9'
    }
    if(!aceptado){
        alert("El teléfono tiene que estar compuesto solo de números")
    }else{
        aceptado = telefono.length === 9
        if(!aceptado){
            alert("El teléfono tiene que tener 9 números")
        }
    }

    return aceptado
    
}

// /regex/.test(string)
// funciones creadas por chatgpt

function comprobarNombre(nombre) {
    // Solo letras y espacios
    if (/^[A-Za-z\s]+$/.test(nombre)) {
        return true
    } else {
        alert("Solo se admiten letras y espacios en el nombre")
        return false
    }
}

function comprobarEmail(email) {
    // Comprobar email
    if (/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/.test(email)) {
        return true
    } else {
        alert("Email no válido")
        return false
    }
}

function comprobarNacimiento(nacimiento) {
    // comprobar si encaja con alguna de las 2 yyyy-mm-dd o dd-mm-yyyy siendo números
    if (/^\d{4}-\d{2}-\d{2}$|^\d{2}-\d{2}-\d{4}$/.test(nacimiento)) {
        return true
    } else {
        alert("La fecha de nacimiento debe seguir estos formatos: yyyy-mm-dd o dd-mm-yyyy")
        return false
    }
}

function comprobarUsuario(usuario) {
    // números y letras
    if (/^[a-zA-Z0-9]+$/.test(usuario)) {
        return true
    } else {
        alert("El usuario debe incluir solo números y letras")
        return false
    }
}

function validarDNI(dni) {
    // Expresión regular para validar el formato correcto del DNI
    const dniRegex = /^(\d{8})-([A-Z])$/;
  
    // Verificar si el DNI coincide con el formato esperado
    if (!dniRegex.test(dni)) {
        alert("Formato de DNI no válido")
        return false;
    }
  
    // Extraer el número y la letra del DNI
    const [, numero, letra] = dni.match(dniRegex);
  
    // Array con las letras posibles en un DNI
    const letrasPosibles = 'TRWAGMYFPDXBNJZSQVHLCKE';
  
    // Calcular la letra correcta según el número
    const letraCalculada = letrasPosibles[numero % 23];
  
    // Comparar la letra calculada con la letra proporcionada
    if(letra !== letraCalculada){
        alert("La letra del DNI no es correcta")
    }
    return letra === letraCalculada;
  }
  




