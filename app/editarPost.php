<!DOCTYPE html>
<html>
    <head>
        <title>Eventify</title>
        <link rel="stylesheet" href="editarPost.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <!-- Fuente de letra roboto de Google  https://fonts.google.com/specimen/Roboto -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <body>
      <?php 
        include("navbar.php");
      ?>
      <div class="page">
      <div class="cabecera">
          <img class="imagenSV" src="imagenes/logoSV.png"></img>
          <h1 class="tituloInicio">Editar Eventos</h1>
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

          
          if(isset($_COOKIE["user"])){
            $usuario = $_COOKIE["user"];
          }else{
            $usuario = "invitado";
          }

          
          $query = mysqli_query($conn, "SELECT * FROM eventos WHERE usuario='".$usuario."'")
          or die (mysqli_error($conn));
          while ($row = mysqli_fetch_array($query)) {
            echo "
            <div class='evento'>
                <div class='barraUsuario'>
                  <form action='/editar.php' method='POST'>
                    <input name='titulo' type='hidden' value='".htmlspecialchars($row['titulo'], ENT_QUOTES)."'>
                    <button class='botonEditar'> Editar </button>
                  </form>
                  <button class='botonEliminar'> Eliminar evento </button>
                </div>
                <h2 class='tituloEvento no-overflow'>{$row['titulo']}</h2>
                <p class='descripcionEvento no-overflow'>{$row['enunciado']}</p>
            </div>
            ";
          }
          

          
        ?>
      </div>
      <script src="eliminarEvento.js"></script>
    </body>
</html>