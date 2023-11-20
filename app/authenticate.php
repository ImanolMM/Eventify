<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

    use Firebase\JWT\JWT;
    require_once('./vendor/autoload.php');

    $usuario = $_POST["usuario"];
    $passwd = $_POST["passwd"];

    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db); 
    if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
    }

    $hasValidCredentials = false;

    $consulta_usuario = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = mysqli_prepare($conn, $consulta_usuario);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $passCorrecta = false;
    $ip_usuario = $_SERVER['REMOTE_ADDR'];

    while ($row = mysqli_fetch_array($result)) {
        $sal = $row['sal'];
        $con = $sal . $passwd;
        $passCorrecta = password_verify($con, $row['passwd']);
    }

    $consulta_accesos = "SELECT intentos FROM accesos WHERE usuario = ? AND ip = ? AND fecha = CURDATE()";
    $stmt = mysqli_prepare($conn, $consulta_accesos);
    mysqli_stmt_bind_param($stmt, "ss", $usuario, $ip_usuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $intentos=0;
    if ($row = mysqli_fetch_array($result)) {
        $intentos = $row['intentos'];
    } 
    if ($passCorrecta && $intentos < 5) {
        $mensaje = "Inicio de sesión correcto";
        $hasValidCredentials = true;
    }
    else if ($intentos >= 5) {
        $mensaje = "Demasiados intentos, espere 24 horas";
    }
    else {
        if ($intentos === 0) {
            $intentos = 1;
            $insert_accesos = "INSERT INTO accesos(usuario, ip, intentos, fecha) VALUES(?, ?, 1, CURDATE())";
            $stmt = mysqli_prepare($conn, $insert_accesos);
            mysqli_stmt_bind_param($stmt, "ss", $usuario, $ip_usuario);
            mysqli_stmt_execute($stmt);
        } else {
            $intentos = $intentos + 1;
            $cambiar_accesos = "UPDATE accesos SET intentos = ? WHERE usuario = ? AND ip = ? AND fecha = CURDATE()";
            $stmt = mysqli_prepare($conn, $cambiar_accesos);
            mysqli_stmt_bind_param($stmt, "sss", $intentos, $usuario, $ip_usuario);
            mysqli_stmt_execute($stmt);
        }
        
        
        
        $mensaje = "Usuario o contraseña incorrecta";
    }


    if ($hasValidCredentials) {
        $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mIQyzqaS74Q4oR1ew=';
        $tokenId    = base64_encode(random_bytes(16));
        $issuedAt   = new DateTimeImmutable();
        $expire     = $issuedAt->modify('+720 minutes')->getTimestamp();                                  

        // Create the token as an array
        $data = [
            'iat'  => $issuedAt->getTimestamp(),    // Issued at: time when the token was generated
            'jti'  => $tokenId,                     // Json Token Id: an unique identifier for the token
            'nbf'  => $issuedAt->getTimestamp(),    // Not before
            'exp'  => $expire,                      // Expire
            'data' => [                             // Data related to the signer user
                'userName' => $usuario,            // User name
            ]
        ];

        // Encode the array to a JWT string.
        echo JWT::encode(
            $data,      //Data to be encoded in the JWT
            $secretKey, // The signing key
            'HS512'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );
    }else echo $mensaje;
?>