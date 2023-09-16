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
      <div class="navbar">
        <ul>
          <li>
            <a class="link" href="/">Inicio</a>
          </li>
          <li>
            <a class="link" href="">Registro</a>
          </li>
        </ul>
      </div>
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
            <!-- https://stackoverflow.com/questions/4309950/how-to-align-input-forms-in-html -->
            <form class="form">
                <div class="linea-form">
                    <p>Nombre</p>
                    <input type="text">
                </div>
                <div class="linea-form">
                    <p>Teléfono</p>
                    <input type="text">
                </div>
                <div class="linea-form">
                    <p>Edad</p>
                    <input type="number">
                </div>
                <div class="linea-form">
                    <p>Género</p>
                    <div class="genero">
                        <input type="radio" name="genero"></input>Hombre
                        <input type="radio" name="genero"></input>Mujer
                        <input type="radio" name="genero"></input>Otro
                    </div>
                </div>
                <div class="linea-form">
                    <p>Contraseña</p>
                    <input type="password">
                </div>
                <button type="submit" class="boton">Crear</button>
            </form>

        </div>
      </div>
    </body>
</html>