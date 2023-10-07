<!DOCTYPE html>
<html>
    <head>
        <title>Eventify</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="login.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <!-- Fuente de letra roboto de Google  https://fonts.google.com/specimen/Roboto -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <body>
    <script src="form.js"></script>
      <?php 
        include("navbar.php");
      ?>
      <div class="page">
        <?php
          $hostname = "db";
          $username = "admin";
          $password = "test";
          $db = "database";

          $conn = mysqli_connect($hostname,$username,$password,$db);
          if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
          }



        $query = mysqli_query($conn, "SELECT * FROM usuarios")
          or die (mysqli_error($conn));
        ?>

        <div class="formbox">
            <div class="form-title">
                Iniciar sesión
            </div>
            <p class="desc">
                A continuación se muestran ejemplos para cada campo
            </p>
            <!-- Alinear inputs https://stackoverflow.com/questions/4309950/how-to-align-input-forms-in-html -->
            <form class="form" action="/submit.php" id="form-registro" method="POST">
                <div class="linea-form" id="linea-nombre">
                    <p>Nombre y Apellidos: Jon Tom</p>
                    <input type="text" name="nombre">
                </div>
                <div class="linea-form" id="linea-telefono">
                    <p>Teléfono: 123456789</p>
                    <input type="text" name="telefono">
                </div>
                <div class="linea-form" id="linea-dni">
                    <p>DNI: 11111111-Z </p>
                    <input type="text" name="dni">
                </div>
                <div class="linea-form" id="linea-email">
                    <p>Email: jontom@gmail.com</p>
                    <input type="email" name="email">
                </div>
                <div class="linea-form" id="linea-nacimiento">
                    <p>Fecha de nacimiento</p>
                    <input type="date" name="nacimiento">
                </div>
                <div class="linea-form">
                    <p id="usuario-texto">Nombre de usuario:</p>
                    <input type="text" name="usuario">
                </div>
                <div class="linea-form">
                    <p id="passwd-texto">Contraseña:</p>
                    <input type="password" name="passwd">
                </div>
                <div class="linea-form">
                  <input type="hidden" value="signin" name="tiporegistro">
                  <p>
                    <button type="submit" class="boton" id="botonRegistro">Realizar</button>
                  </p>                  
                  <button class="boton" id="botonIniciar">Cambiar a Crear cuenta</button>
                </div>
              </form>

        </div>
      </div>
    </body>
</html>