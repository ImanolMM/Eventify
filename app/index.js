//Iconos de google: https://fonts.google.com/icons?selected=Material+Icons
const botonesDescarga = document.querySelectorAll('.botonDescarga');
//codigo para descargar archivos: https://stackoverflow.com/questions/3665115/how-to-create-a-file-in-memory-for-user-to-download-but-not-through-server
botonesDescarga.forEach(boton => {
    boton.addEventListener('click', () => {
        const titulo = boton.parentElement.querySelector('.tituloEvento').innerText;
        const opcion1 = boton.parentElement.querySelector('.opcion1').value;
        const opcion2 = boton.parentElement.querySelector('.opcion2').value;
        const resultado1 = boton.parentElement.querySelector('.resultado1').value;
        const resultado2 = boton.parentElement.querySelector('.resultado2').value;
        const texto = 'Título: ' +  titulo + '\n' + 'Descripción: ' + boton.parentElement.querySelector('.descripcionEvento').innerText
        + '\n' + 'Opción 1: ' + opcion1 + '\n' + 'Resultado 1: ' + resultado1 + '\n' + 'Opcion 2: ' + opcion2 + '\n' + 'Resultado 2: ' + resultado2;
        
        var element = document.createElement('a');
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(texto));
        element.setAttribute('download', titulo  + '.txt');

        element.style.display = 'none';
        document.body.appendChild(element);

        element.click();

        document.body.removeChild(element);
        
    });
})

