window.onload = init
// https://stackoverflow.com/q/8935632 comprobar números
// https://stackoverflow.com/q/9862761 comprobar letras
function init() {
  const botonesEliminar = document.querySelectorAll('.botonEliminar');

  botonesEliminar.forEach(function (boton) {
    boton.addEventListener('click', function () {

      event.preventDefault();
 
      //acceso a la base de datos
 
      const eventoPadre = boton.parentElement.parentElement;

      
      
      console.log(eventoPadre)      

      eventoPadre.remove();
      boton.remove();

      // https://stackoverflow.com/questions/71678250/how-to-post-body-data-using-fetch-api

      const urlencoded = new URLSearchParams({
        "titulo": `${eventoPadre.querySelector('.tituloEvento').innerHTML}`,
      });

      fetch('/eliminar_evento.php', {
        method: 'POST',
        body: urlencoded
      }).then(response => response.text())
      .then(text => console.log(text))
      .catch(error => console.error(error));

    })
  })
}
