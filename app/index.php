<!DOCTYPE html>
<html>
    <head>
        <title>Eventify</title>
        <link rel="stylesheet" href="styles.css">
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
            <a class="linkInicio" href="/">Crear Evento</a>
          </li>
          <li>
            <a class="linkLogin" href="/login.php">Login</a>
          </li>
        </ul>
      </div>
      <div class="page">
      <div class="cabecera">
          <img class="imagenSV" src="imagenes/logoWIP.png"></img>
          <a class="titulo" shref="/">Inicio</a>
          <img class="imagenWIP" src="imagenes/logoWIP.png"></img>
        </div>
        <?php
          echo '<h1>Yeah, it works!<h1>';
          // phpinfo();
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

        while ($row = mysqli_fetch_array($query)) {
          echo
          "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nombre']}</td>
          </tr>";
          

        }

        ?>
      </div>
    </body>
</html>