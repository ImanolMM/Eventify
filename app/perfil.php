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
          <h1 class="tituloInicio">Editar Perfil</h1>
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

            $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE usuario = '".$usuario."'")
            or die (mysqli_error($conn));
        
            while ($row = mysqli_fetch_array($query)) {
            echo '<div class="formbox">
                    <div class="form-title">
                        Mi Perfil
                    </div>
                    <!-- Alinear inputs https://stackoverflow.com/questions/4309950/how-to-align-input-forms-in-html -->
                    <form class="form" action="/submit.php" id="form-registro" method="POST">
                        <div class="linea-form">
                            <p>Nombre de usuario: '.$row['usuario'].'</p>
                        </div>
                        <div class="linea-form">
                            <p>Nombre y Apellidos: '.$row['nombre'].'</p>
                            <input type="text" name="nombre" value="'.$row['nombre'].'">
                        </div>
                        <div class="linea-form">
                            <p>Teléfono: '.$row['telef'].'</p>
                            <input type="text" name="telefono" value="'.$row['telef'].'">
                        </div>
                        <div class="linea-form">
                            <p>DNI: '.$row['dni'].' </p>
                            <input type="text" name="dni" value="'.$row['dni'].'">
                        </div>
                        <div class="linea-form">
                            <p>Email: '.$row['email'].'</p>
                            <input type="email" name="email" value="'.$row['email'].'">
                        </div>
                        <div class="linea-form">
                            <p>Nacimiento: '.$row['nacimiento'].'</p>
                            <input type="date" name="nacimiento" value="'.$row['nacimiento'].'">
                        </div>
                        <div class="linea-form">
                            <p>Contraseña: '.$row['passwd'].' </p>
                            <input type="password" name="passwd" value="'.htmlspecialchars($row['passwd'], ENT_QUOTES).'">
                        </div>
                        <div class="linea-form">
                            <input type="hidden" value="edit" name="tiporegistro">
                            <p>
                            <button type="submit" class="boton" id="botonPerfil">Editar</button>
                            </p>                  
                        </div>
                    </form>
                </div>';
            }
            ?>
            <script src="perfil.js"></script>
      </div>
    </body>
</html>