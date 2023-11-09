<?php
include("navbar.php");
$_SESSION['token'] = md5(uniqid(mt_rand(), true));

if (isset($_POST['titulo'])) {
  $titulo = $_POST['titulo'];
  
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

  // Utilizar una consulta preparada para evitar la inyección SQL
  $query = "SELECT * FROM eventos WHERE titulo = ? AND usuario = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ss", $titulo, $usuario);
  $stmt->execute();

  $result = $stmt->get_result();

  while ($row = $result->fetch_assoc()) {
    echo '<div class="formbox">
              <div class="form-title">
                  Edición de evento
              </div>
              <!-- Alinear inputs https://stackoverflow.com/questions/4309950/how-to-align-input-forms-in-html -->
              <form class="form" action="/submit_eventos.php" id="form-registro" method="POST">
                  <div class="linea-form">
                      <p>Titulo: ' . $row['titulo'] . '</p>
                      <input type="text" name="titulo" value="' . htmlspecialchars($row['titulo'], ENT_QUOTES) . '">
                      <input type="hidden" name="viejoTitulo" value="' . htmlspecialchars($row['titulo'], ENT_QUOTES) . '">
                  </div>
                  <div class="linea-form">
                      <p>Enunciado: ' . $row['enunciado'] . '</p>
                      <input type="text" name="enunciado" value="' . htmlspecialchars($row['enunciado'], ENT_QUOTES) . '">
                  </div>
                  <div class="linea-form">
                      <p>Opcion1: ' . $row['opcion1'] . ' </p>
                      <input type="text" name="opcion1" value="' . htmlspecialchars($row['opcion1'], ENT_QUOTES) . '">
                  </div>
                  <div class="linea-form">
                      <p>Resultado1: ' . $row['resultado1'] . '</p>
                      <input type="text" name="resultado1" value="' . htmlspecialchars($row['resultado1'], ENT_QUOTES) . '">
                  </div>
                  <div class="linea-form">
                      <p>Opcion2: ' . $row['opcion2'] . '</p>
                      <input type="text" name="opcion2" value="' . htmlspecialchars($row['opcion2'], ENT_QUOTES) . '">
                  </div>
                  <div class="linea-form">
                      <p>Resultado2: ' . $row['resultado2'] . '</p>
                      <input type="text" name="resultado2" value="' . htmlspecialchars($row['resultado2'], ENT_QUOTES) . '">
                  </div>
                  <div class="linea-form">
                      <input type="hidden" value="edit" name="flagedit">
                      <p>
                      <button type="submit" class="boton" id="botonRegistro">Editar</button>
                      </p>                  
                  </div>
                  <input type="hidden" name="token" value='.$_SESSION['token'].'>
              </form>
          </div>';
  }

  $stmt->close();
  $conn->close();
}
?>
