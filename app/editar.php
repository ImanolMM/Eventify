<?php
include("functionsJWT.php");

if (isset($_POST['titulo'])) {
    session_set_cookie_params([
        'lifetime' => 0,    // Duración de la sesión (0 para sesión hasta que se cierre el navegador)
        'path' => '/',      // Ruta para la cual la cookie está disponible
        'domain' => '',     // Dominio para el cual la cookie está disponible (dejar en blanco para el dominio actual)
        'secure' => false,   // Si true, solo se enviará la cookie sobre conexiones seguras (HTTPS)
        'httponly' => true, // La cookie solo es accesible desde el lado del servidor
        'samesite' => 'Restrict' 
    ]);
    session_start();
    if (!isset($_SESSION['token'])){
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }  
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
    include("navbar.php");  
    while ($row = $result->fetch_assoc()) {
        echo '
            <div class="formbox">
            <link rel="stylesheet" href="editar.css">
            <link rel="stylesheet" href="crearEvento.css">
                <div class="form-title">
                    Edición de evento
                </div>
                <!-- Alinear inputs https://stackoverflow.com/questions/4309950/how-to-align-input-forms-in-html -->
                <form class="form" action="/submitEventos.php" id="form-registro" method="POST">
                    <div class="linea-form">
                        <p>Titulo: ' . htmlspecialchars($row['titulo'], ENT_QUOTES)  . '</p>
                        <input type="text" name="titulo" value="' . htmlspecialchars($row['titulo'], ENT_QUOTES) . '">
                        <input type="hidden" name="viejoTitulo" value="' . htmlspecialchars($row['titulo'], ENT_QUOTES) . '">
                    </div>
                    <div class="linea-form">
                        <p>Enunciado: ' . htmlspecialchars($row['enunciado'], ENT_QUOTES) . '</p>
                        <input type="text" name="enunciado" value="' . htmlspecialchars($row['enunciado'], ENT_QUOTES) . '">
                    </div>
                    <div class="linea-form">
                        <p>Opcion1: ' . htmlspecialchars($row['opcion1'], ENT_QUOTES)  . ' </p>
                        <input type="text" name="opcion1" value="' . htmlspecialchars($row['opcion1'], ENT_QUOTES) . '">
                    </div>
                    <div class="linea-form">
                        <p>Resultado1: ' . htmlspecialchars($row['resultado1'], ENT_QUOTES)  . '</p>
                        <input type="text" name="resultado1" value="' . htmlspecialchars($row['resultado1'], ENT_QUOTES) . '">
                    </div>
                    <div class="linea-form">
                        <p>Opcion2: ' . htmlspecialchars($row['opcion2'], ENT_QUOTES)  . '</p>
                        <input type="text" name="opcion2" value="' . htmlspecialchars($row['opcion2'], ENT_QUOTES) . '">
                    </div>
                    <div class="linea-form">
                        <p>Resultado2: ' . htmlspecialchars($row['resultado2'], ENT_QUOTES)  . '</p>
                        <input type="text" name="resultado2" value="' . htmlspecialchars($row['resultado2'], ENT_QUOTES) . '">
                    </div>
                    <div class="linea-form">
                        <input type="hidden" value="edit" name="flagedit">
                        <input type="hidden" name="token" value="'.$_SESSION['token'].'">
                        <p>
                        <button type="submit" class="boton" id="botonRegistro">Editar</button>
                        </p>                  
                    </div>
                </form>
            </div>';
  }

  $stmt->close();
  $conn->close();
}
?>
