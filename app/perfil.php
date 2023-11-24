<?php
      session_start(); 
      include("functionsJWT.php");

        
        if (!isset($_SESSION['token'])){
          $_SESSION['token'] = bin2hex(random_bytes(32));
        }

        $hostname = "db";
        $username = "admin";
        $password = "test";
        $db = "database";

        $conn = mysqli_connect($hostname, $username, $password, $db);
        if ($conn->connect_error) {
          die("Database connection failed: " . $conn->connect_error);
        }

        if (comprobarCookieUsuario()) {
          $usuario = getUsuarioCookie();
        } else {
          $usuario = "invitado";
        }

        $query = "SELECT * FROM usuarios WHERE usuario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        include("navbar.php");
        echo '<!DOCTYPE html>
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
            
            <div class="page">
              <div class="cabecera">
                <img class="imagenSV" src="imagenes/logoSV.png"></img>
                <h1 class="tituloInicio">Editar Perfil</h1>
                <img class="imagenWIP" src="imagenes/logoWIP.png"></img>
              </div>';
        while ($row = $result->fetch_assoc()) {
          echo '<div class="formbox">
                  <div class="form-title">
                      Mi Perfil
                  </div>
                  <!-- Alinear inputs https://stackoverflow.com/questions/4309950/how-to-align-input-forms-in-html -->
                  <form class="form" action="/submit.php" id="form-registro" method="POST">
                      <div class="linea-form">
                          <p>Nombre de usuario: '.htmlspecialchars($row['usuario'], ENT_QUOTES).'</p>
                      </div>
                      <div class="linea-form">
                          <p>Nombre y Apellidos: '.htmlspecialchars($row['nombre'], ENT_QUOTES).'</p>
                          <input type="text" name="nombre" value="'.htmlspecialchars($row['nombre'], ENT_QUOTES).'">
                      </div>
                      <div class="linea-form">
                          <p>Teléfono: '.htmlspecialchars($row['telef'], ENT_QUOTES).'</p>
                          <input type="text" name="telefono" value="'.htmlspecialchars($row['telef'], ENT_QUOTES).'">
                      </div>
                      <div class="linea-form">
                          <p>DNI: '.htmlspecialchars($row['dni'], ENT_QUOTES).' </p>
                          <input type="text" name="dni" value="'.htmlspecialchars($row['dni'], ENT_QUOTES).'">
                      </div>
                      <div class="linea-form">
                          <p>Email: '.htmlspecialchars($row['email'], ENT_QUOTES).'</p>
                          <input type="email" name="email" value="'.htmlspecialchars($row['email'], ENT_QUOTES).'">
                      </div>
                      <div class="linea-form">
                          <p>Nacimiento: '.htmlspecialchars($row['nacimiento'], ENT_QUOTES).'</p>
                          <input type="date" name="nacimiento" value="'.htmlspecialchars($row['nacimiento'], ENT_QUOTES).'">
                      </div>
                      <div class="linea-form">
                          <p>Contraseña </p>
                          <input type="password" name="passwd" value="">
                      </div>
                      <div class="linea-form">
                          <input type="hidden" value="edit" name="tiporegistro">
                          <p>
                          <button type="submit" class="boton" id="botonPerfil">Editar</button>
                          </p>                  
                      </div>
                      <input type="hidden" name="token" value="'.$_SESSION['token'].'">
                  </form>
              </div>';
        }

        $stmt->close();
        $conn->close();
      ?>
      <script src="perfil.js"></script>
    </div>
  </body>
</html>
