<!DOCTYPE html>
<html>
    <head>
        <title>Eventify</title>
        <link rel="stylesheet" href="crearEvento.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <!-- Fuente de letra roboto de Google  https://fonts.google.com/specimen/Roboto  -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <body>
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
                Crear evento
            </div>
            <p class="desc">
                Construya su evento aqui
            </p>
            <!-- Alinear inputs https://stackoverflow.com/questions/4309950/how-to-align-input-forms-in-html -->
            <form class="form" action="/submit_eventos.php" id="form-crear" method="POST">
                <div class="linea-form">
                    <p>Titulo</p>
                    <input type="text" name="titulo">
                </div>
                <div class="linea-form">
                    <p>Enunciado</p>
                    <input type="text" name="enunciado">
                </div>
                <div class="linea-form">
                    <p>Opcion 1 </p>
                    <input type="text" name="opcion1">
                </div>
                <div class="linea-form">
                    <p>Resultado 1</p>
                    <input type="text" name="resultado1">
                </div>
                <div class="linea-form">
                    <p>Opcion 2</p>
                    <input type="text" name="opcion2">
                </div>
                <div class="linea-form">
                    <p>Resultado 2</p>
                    <input type="text" name="resultado2">
                </div>
                <button type="submit" class="boton">Crear</button>
            </form>

        </div>
      </div>
    </body>
</html>