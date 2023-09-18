<?php
    // https://www.freecodecamp.org/news/creating-html-forms/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
        if(!$existeUsuario){

            $consulta = "INSERT INTO usuarios VALUES(?, ?, ?, ?, ?, ?, ?)";
            $tipos = "sisssss";
            $parametros = array($nombre, (int) $telef, $dni, $email, $nacimiento, $usuario, $passwd);
            if($stmt = mysqli_prepare($conn, $consulta)){
                    $stmt->bind_param($tipos, ...$parametros);
                    $stmt->execute();
                    $stmt->close();
                    $mensaje = "Usuario creado";
            }

            // https://www.w3schools.com/php/func_network_setcookie.asp
            $cookie_name = "user";
            $cookie_value = $usuario;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 1 dia de duración
        }else{
            if($tipo == "signin"){
                // iniciar sesión, comprobar contraseña

                $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE usuario = '" . $usuario ."'")
                    or die (mysqli_error($conn));

                $passCorrecta = false;

                while ($row = mysqli_fetch_array($query)) {
                    $passCorrecta = $row['passwd'] == $passwd;
                }

                if($passCorrecta){
                    $mensaje = "Inicio de sesión correcto";
                    $cookie_name = "user";
                    $cookie_value = $usuario;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 1 dia de duración
                }
                
            }else{
                $mensaje = "Ya existe un usuario con ese nombre de usuario";
            }
            
        }
        
    }else{
        header("/"); // redirigimos a inicio si no es POST
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
            readfile("navbar.html");
        ?>
        <div class="page mensaje">
            <?php
                echo $mensaje; 
            ?> 
        </div>
    </body>
</html>
