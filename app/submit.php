<?php
    function comprobarNombre($nombre) {
        // Solo letras y espacios
        if (preg_match('/^[A-Za-z\sñÑáéíóúÁÉÍÓÚçÇ]+$/', $nombre)) {
            return true;
        } else {
            return false;
        }
    }
    
    function comprobarEmail($email) {
        // Comprobar email
        if (preg_match('/^[a-zA-Z0-9._-ñÑ]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/', $email)) {
            return true;
        } else {
            return false;
        }
    }
    
    function comprobarNacimiento($nacimiento) {
        // comprobar si encaja con alguna de las 2 yyyy-mm-dd o dd-mm-yyyy siendo números
        if (preg_match('/^\d{4}-\d{2}-\d{2}$|^\d{2}-\d{2}-\d{4}$/', $nacimiento)) {
            return true;
        } else {
            return false;
        }
    }
    
    function comprobarUsuario($usuario) {
        // números y letras
        if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚçÇ]+$/', $usuario)) {
            return true;
        } else {
            return false;
        }
    }
    
    function validarDNI($dni) {
        // Expresión regular para validar el formato correcto del DNI
        $dniRegex = '/^(\d{8})-([A-Z])$/';
    
        // Verificar si el DNI coincide con el formato esperado
        if (!preg_match($dniRegex, $dni, $matches)) {
            return false;
        }
    
        // Extraer el número y la letra del DNI
        list(, $numero, $letra) = $matches;
    
        // Array con las letras posibles en un DNI
        $letrasPosibles = 'TRWAGMYFPDXBNJZSQVHLCKE';
    
        // Calcular la letra correcta según el número
        $letraCalculada = $letrasPosibles[$numero % 23];
    
        // Comparar la letra calculada con la letra proporcionada
        if ($letra !== $letraCalculada) {
            return false;
        }
        
        return $letra === $letraCalculada;
    }
    
    function comprobarPasswd($passwd) {
        if (strlen($passwd) > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function logFailedSignUpAttempt($username, $ipAddress, $message) {
        $logDirectory = "logs";
        $logFile = $logDirectory . "/failed_signin_attempts.log";
        $timestamp = date("Y-m-d H:i:s");
        
        // Mensaje de registro
        $logMessage = "$message at $timestamp from IP $ipAddress for user $username\n";
        
        // Guardar el registro en el archivo
        file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
    }
    //cambiar database.sql, poner on update cascade
    // https://www.freecodecamp.org/news/creating-html-forms/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        //Evitar CSRF
        $token = $_POST["token"];

        if (!$token || $token !== $_SESSION['token']) {
            // return 405 http status code
            //header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            //exit;
            
        }

        $nombre = $_POST["nombre"];
        $telef = $_POST["telefono"];
        $dni = $_POST["dni"];
        $email = $_POST["email"];
        $nacimiento = $_POST["nacimiento"];
        $usuario = $_POST["usuario"];
        $passwd = $_POST["passwd"];
        $tipo = $_POST["tiporegistro"];

        $hostname = "db";
        $username = "admin";
        $password = "test";
        $db = "database";

        $conn = mysqli_connect($hostname,$username,$password,$db); 
        if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
        }

        $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE usuario = '" . $usuario ."'")
            or die (mysqli_error($conn));

        $existeUsuario = false;

        while ($row = mysqli_fetch_array($query)) {
            $existeUsuario = $existeUsuario || ($row['usuario'] == $usuario);
        }

        // https://www.php.net/manual/es/mysqli.prepare.php en los comentarios, el de urso
        if($tipo == "signup" && !$existeUsuario){
            $error = false;
            $motivo = "";
            if (!comprobarEmail($email)){
                $error = true;
                $motivo = "Email no válido";
            }elseif (!comprobarNombre($nombre)){
                $error = true;
                $motivo = "Nombre no válido";
            }elseif (!comprobarNacimiento($nacimiento)){
                $error = true;
                $motivo = "Fecha de nacimiento no válida";
            }elseif (!comprobarUsuario($usuario)){
                $error = true;
                $motivo = "Usuario no válido";
            }elseif (!validarDNI($dni)){
                $error = true;
                $motivo = "DNI no válido";
            }elseif (!comprobarPasswd($passwd)){
                $error = true;
                $motivo = "Contraseña no válida";
            }

            if (!$error){
                $consulta = "INSERT INTO usuarios(nombre,telef,dni,email,nacimiento,usuario,passwd,sal) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
                $sal = bin2hex(random_bytes(16));
                $contraseñaSal = $sal . $passwd;
                $contraseña = password_hash($contraseñaSal, PASSWORD_BCRYPT);
                $tipos = "sissssss";
                $parametros = array($nombre, (int) $telef, $dni, $email, $nacimiento, $usuario, $contraseña, $sal);
                
                if($stmt = mysqli_prepare($conn, $consulta)){
                    $stmt->bind_param($tipos, ...$parametros);
                    $stmt->execute();
                    $stmt->close();
                    $mensaje = "Usuario creado";
                    // https://www.w3schools.com/php/func_network_setcookie.asp
                    $cookie_name = "user";
                    $cookie_value = $usuario;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 1 dia de duración
                }
            }else{
                //guardar logs en un fichero
                $logDirectory = "logs";

                if (!is_dir($logDirectory)) {
                    mkdir($logDirectory, 0755, true);
                }
                $ipAddress = $_SERVER['REMOTE_ADDR'];
                logFailedSignUpAttempt($usuario, $ipAddress, $motivo);
            }

            
            header("Location: /");
            exit();
        }else{
            if($tipo === "signin" && !$error){
                // iniciar sesión, comprobar contraseña

                $consulta_usuario = "SELECT * FROM usuarios WHERE usuario = ?";
                $stmt = mysqli_prepare($conn, $consulta_usuario);
                mysqli_stmt_bind_param($stmt, "s", $usuario);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                $passCorrecta = false;
                $ip_usuario = $_SERVER['REMOTE_ADDR'];

                while ($row = mysqli_fetch_array($result)) {
                    $con = $row['sal'] . $passwd;
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
                    $cookie_name = "user";
                    $cookie_value = $usuario;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 1 día de duración
                    header("Location: /");
                    exit();
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
                
                
            }else if($tipo == "edit"){
                if(isset($_COOKIE["user"])){
                    $viejoUsuario = $_COOKIE["user"];

                    $consulta = "UPDATE usuarios SET nombre = ?, telef = ?, dni = ?, email = ?, nacimiento = ?, passwd = ?, sal = ? WHERE usuario = ?";
                    $tipos = "sissssss";
                    $sal = bin2hex(random_bytes(16));
                    $contraseñaSal = $sal . $passwd;
                    $contraseña = password_hash($contraseñaSal, PASSWORD_BCRYPT);
                    $parametros = array($nombre, (int) $telef, $dni, $email, $nacimiento, $contraseña, $sal, $viejoUsuario);
                    if($stmt = mysqli_prepare($conn, $consulta)){
                            $stmt->bind_param($tipos, ...$parametros);
                            if($stmt->execute()){

                                $mensaje = "Usuario editado";
                                setcookie("user", $viejoUsuario, time() + (86400 * 30), "/");

                            } 
                            else $mensaje = "Error al editar";
                            $stmt->close();
                    }
                }
                
            }else{
                $mensaje = "Ya existe un usuario con ese nombre de usuario";
            }
            
        }
        
    }else{
        header("Location: /"); // redirigimos a inicio si no es POST
        exit();
    }
    
    ?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Eventify
        </title>
        <link rel="stylesheet" href="submit.css">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php 
            include("navbar.php");
        ?>
        <div class="page mensaje">
            <?php
                echo $mensaje; 
            ?> 
        </div>
    </body>
</html>
