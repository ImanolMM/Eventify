<!DOCTYPE html>
<html>
    <head>
        <title>Eventify</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="perfil.css">
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
          <h1 class="tituloInicio">Editar Evento</h1>
          <img class="imagenWIP" src="imagenes/logoWIP.png"></img>
        </div>
        <?php
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

          $titulo = $_POST['titulo'];

          $query = mysqli_query($conn, "SELECT * FROM eventos WHERE titulo = '".$titulo."' ". "AND usuario = '".$usuario."'")
          or die (mysqli_error($conn));
      
          while ($row = mysqli_fetch_array($query)) {
          echo '<div class="formbox">
                  <div class="form-title">
                      Edición de evento
                  </div>
                  <!-- Alinear inputs https://stackoverflow.com/questions/4309950/how-to-align-input-forms-in-html -->
                  <form class="form" action="/submit_eventos.php" id="form-registro" method="POST">
                      <div class="linea-form">
                          <p>Titulo: '.$row['titulo'].'</p>
                          <input type="text" name="titulo" value="'.htmlspecialchars($row['titulo'], ENT_QUOTES).'">
                          <input type="hidden" name="viejoTitulo" value="'.htmlspecialchars($row['titulo'], ENT_QUOTES).'">
                      </div>
                      <div class="linea-form">
                          <p>Enunciado: '.$row['enunciado'].'</p>
                          <input type="text" name="enunciado" value="'.htmlspecialchars($row['enunciado'], ENT_QUOTES).'">
                      </div>
                      <div class="linea-form">
                          <p>Opcion1: '.$row['opcion1'].' </p>
                          <input type="text" name="opcion1" value="'.htmlspecialchars($row['opcion1'], ENT_QUOTES).'">
                      </div>
                      <div class="linea-form">
                          <p>Resultado1: '.$row['resultado1'].'</p>
                          <input type="text" name="resultado1" value="'.htmlspecialchars($row['resultado1'], ENT_QUOTES).'">
                      </div>
                      <div class="linea-form">
                          <p>Opcion2: '.$row['opcion2'].'</p>
                          <input type="text" name="opcion2" value="'.htmlspecialchars($row['opcion2'], ENT_QUOTES).'">
                      </div>
                      <div class="linea-form">
                          <p>Resultado2: '.$row['resultado2'].'</p>
                          <input type="text" name="resultado2" value="'.htmlspecialchars($row['resultado2'], ENT_QUOTES).'">
                      </div>
                      <div class="linea-form">
                          <input type="hidden" value="edit" name="flagedit">
                          <p>
                          <button type="submit" class="boton" id="botonRegistro">Editar</button>
                          </p>                  
                      </div>
                  </form>
              </div>';
          }
        ?>
      </div>
    </body>
</html>