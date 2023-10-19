<!DOCTYPE html>
<html>
    <head>
        <title>Eventify</title>
        <link rel="stylesheet" href="styles.css">
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
          <h1 class="tituloInicio">Inicio</h1>
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

          $query = mysqli_query($conn, "SELECT * FROM eventos")
            or die (mysqli_error($conn));

          while ($row = mysqli_fetch_array($query)) {
            echo "
            <div class='evento'>
                <div class='barraUsuario'>
                  <span class='material-symbols-outlined'> account_circle</span>
                  <p class='nombreUsuarioEvento no-overflow'>{$row['usuario']}</p>
                </div>
                <h2 class='tituloEvento no-overflow'>{$row['titulo']}</h2>
                <p class='descripcionEvento'>{$row['enunciado']}</p>
                <span class='material-symbols-outlined botonDescarga'> download</span>
                <!--chapuza-->
                <input type='hidden' class='opcion1' value='".htmlspecialchars($row['opcion1'], ENT_QUOTES)."'>
                <input type='hidden' class='resultado1' value='".htmlspecialchars($row['resultado1'], ENT_QUOTES)."'>
                <input type='hidden' class='opcion2' value='".htmlspecialchars($row['opcion2'], ENT_QUOTES)."'>
                <input type='hidden' class='resultado2' value='".htmlspecialchars($row['resultado2'], ENT_QUOTES)."'>
            </div>
            ";
          }
          
        ?>
      <script src="index.js"></script>
    </body>
</html>