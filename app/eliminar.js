document.addEventListener('DOMContentLoaded', function () {
  const botonEliminar = document.querySelectorAll('.botonEliminar');

  botonEliminar.forEach(function (boton) {
    boton.addEventListener('click', function () {
      const id = boton.getAttribute('data-id');
      
      // Envía una solicitud POST al servidor para eliminar el registro
      fetch('eliminar_registro.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: id }),
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (data) {
          if (data.success) {
            // Elimina el botón del DOM si se eliminó correctamente en la base de datos
            boton.remove();
          } else {
            alert('Hubo un error al eliminar el registro.');
          }
        })
        .catch(function (error) {
          console.error('Error:', error);
        });
    });
  });
});
