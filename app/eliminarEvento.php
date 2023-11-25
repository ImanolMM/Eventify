<?php
    $secure = false; // solo https
    $httponly = true; // no se puede acceder  a la cookie con javascript
    $samesite = 'Strict';

    if(PHP_VERSION_ID < 70300) {
        session_set_cookie_params($maxlifetime, '/; SameSite='.$samesite, '', $secure, $httponly);
    } else {
        session_set_cookie_params([
            'lifetime' => $maxlifetime,
            'path' => '/',
            'domain' => '',
            'secure' => $secure,
            'httponly' => $httponly,
            'SameSite' => $samesite
        ]);
    }
    session_start();
    include("functionsJWT.php");
    include("navbar.php");
    // https://www.freecodecamp.org/news/creating-html-forms/
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Evitar CSRF
        $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

        if (!$token || $token !== $_SESSION['token']) {
            // return 405 http status code
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        }
        
        $titulo = $_POST["titulo"];

        $hostname = "db";
        $username = "admin";
        $password = "test";
        $db = "database";

        $conn = mysqli_connect($hostname,$username,$password,$db); 
        if(comprobarCookieUsuario()){
            $usuario = getUsuarioCookie();

        }else{
            $usuario = "invitado";
        }
        
        if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
        }

        $consulta = "DELETE FROM eventos WHERE titulo = ? AND usuario = ?";
        $tipos = "ss";
        $parametros = array($titulo, $usuario);
        if($stmt = mysqli_prepare($conn, $consulta)){
                $stmt->bind_param($tipos, ...$parametros);
                $stmt->execute();
                $stmt->close();
                $mensaje = "Evento eliminado"; // respuesta que recibirá el fetch de eliminarEvento.js
        }else{
            $mensaje = "error";
        }
        $mensaje = $mensaje . " , titulo: " . $titulo;
        echo $mensaje;
    }
?>