<!DOCTYPE html>
<html>
    <head>
        <title>Eventify</title>
        <link rel="stylesheet" href="editarPost.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <!-- Fuente de letra roboto de Google  https://fonts.google.com/specimen/Roboto -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>
      <div class="navbar">
        <ul>
          <li>
            <a class="linkInicio" href="/">Inicio</a>
            <a class="linkInicio" href="/crearEvento.php">Crear Evento</a>
          </li>
          <li>
            <a class="linkLogin" href="/login.php">Login</a>
          </li>
        </ul>
      </div>
      <div class="page">
      <div class="cabecera">
          <img class="imagenSV" src="imagenes/logoSV.png"></img>
          <img class="imagenWIP" src="imagenes/logoWIP.png"></img>
        </div>
        <?php
          // phpinfo();
          $hostname = "db";
          $username = "admin";
          $password = "test";
          $db = "database";

          $conn = mysqli_connect($hostname,$username,$password,$db);
          if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
          }

          


          if(!isset($_COOKIE["user"])) {
          }else {
              $query = mysqli_query($conn, "SELECT * FROM eventos WHERE usuario='".$_COOKIE["user"]."'")
              or die (mysqli_error($conn));

              while ($row = mysqli_fetch_array($query)) {
                echo "
                <div class='evento'>
                    <div class='barraUsuario'>
                    <form action='editar.php' method='post'>
                    <input type='hidden' name='titulo' value={$row['titulo']} />
                    <button class='botonEditar'> Editar </button>
                    </form>
                    </div>
                    <h2 class='tituloEvento'>{$row['titulo']}</h2>
                    <p class='descripcionEvento'>{$row['enunciado']}</p>
                </div>
                ";
              }
          }

          
        ?>
      </div>
      <div class= "evento">
        <div class="barraUsuario">
          <button onClick= class="botonEditar" id="botonEditar"> Editar evento </button>
        </div>
        <h2 class="tituloEvento">Nombre del evento</h2>
        <p class="descripcionEvento">Descripción del evento porque mola porque es la moda, survival vacation al poder. Working In Progress god cabron, me renta descargarme este juego loool que guapo que está dios. Está creado por los mismísmos dioses griegos </p>
      </div>
    </body>
</html>