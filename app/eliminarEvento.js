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

      fetch('/eliminar_evento.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          titulo: eventoPadre.querySelector('.tituloEvento').innerHTML
        })
      })

    })
  })
}
