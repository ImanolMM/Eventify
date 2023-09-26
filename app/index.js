const botonesDescarga = document.querySelectorAll('.botonDescarga');
//codigo para descargar archivos: https://stackoverflow.com/questions/3665115/how-to-create-a-file-in-memory-for-user-to-download-but-not-through-server
botonesDescarga.forEach(boton => {
    boton.addEventListener('click', () => {
        const titulo = boton.parentElement.querySelector('.tituloEvento').innerText + '.txt';
        const texto = boton.parentElement.querySelector('.descripcionEvento').innerText;
        var element = document.createElement('a');
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(texto));
        element.setAttribute('download', titulo);

        element.style.display = 'none';
        document.body.appendChild(element);

        element.click();

        document.body.removeChild(element);
        
    });
})

