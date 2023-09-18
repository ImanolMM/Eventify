<!DOCTYPE html>
<html>
    <head>
        <title>Eventify</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="login.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <!-- Fuente de letra roboto de Google  https://fonts.google.com/specimen/Roboto -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>
    <script src="form.js"></script>
      <?php 
        readfile("navbar.html");
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
                Registro
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
                    <p>Nombre de usuario: JonTom123</p>
                    <input type="text" name="usuario">
                </div>
                <div class="linea-form">
                    <p>Contraseña: asd$27</p>
                    <input type="password" name="passwd">
                </div>
                <div class="linea-form">
                  <input type="hidden" value="signup" name="tiporegistro">
                  <p>
                    <button type="submit" class="boton" id="botonRegistro">Crear</button>
                  </p>                  
                  <button class="boton" id="botonIniciar">Cambiar a Iniciar sesión</button>
                </div>
              </form>

        </div>
      </div>
    </body>
</html>