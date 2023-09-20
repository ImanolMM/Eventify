<!DOCTYPE html>
<html>
    <head>
        <title>Eventify</title>
        <link rel="stylesheet" href="crearEvento.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <!-- Fuente de letra roboto de Google  https://fonts.google.com/specimen/Roboto -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>
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
                Editar evento
            </div>
            <p class="desc">
                Construya su evento aqui
            </p>
            <!-- Alinear inputs https://stackoverflow.com/questions/4309950/how-to-align-input-forms-in-html -->
            <form class="form">
                <div class="linea-form">
                    <p>Titulo</p>
                    <input type="text">
                </div>
                <div class="linea-form">
                    <p>Enunciado</p>
                    <input type="text">
                </div>
                <div class="linea-form">
                    <p>Opcion 1 </p>
                    <input type="text">
                </div>
                <div class="linea-form">
                    <p>Resultado 1</p>
                    <input type="text">
                </div>
                <div class="linea-form">
                    <p>Opcion 2</p>
                    <input type="text">
                </div>
                <div class="linea-form">
                    <p>Resultado 2</p>
                    <input type="text">
                </div>
                <button type="submit" class="boton">Editar</button>
            </form>

        </div>
      </div>
    </body>
</html>