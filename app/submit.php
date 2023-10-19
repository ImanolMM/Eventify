<?php
    //cambiar database.sql, poner on update cascade
    // https://www.freecodecamp.org/news/creating-html-forms/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombre = $_POST["nombre"];
        $telef = $_POST["telefono"];
        $dni = $_POST["dni"];
        $email = $_POST["email"];
        $nacimiento = $_POST["nacimiento"];
        $usuario = $_POST["usuario"];
        $passwd = $_POST["passwd"]; // guardando contraseña sin encriptar :O
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
            header("Location: /");
            exit();
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
                    header("Location: /");
                    exit();
                }else{
                    $mensaje = "Usuario o contraseña incorrecta";
                }
                
                
            }else if($tipo == "edit"){
                if(isset($_COOKIE["user"])){
                    $viejoUsuario = $_COOKIE["user"];

                    $consulta = "UPDATE usuarios SET nombre = ?, telef = ?, dni = ?, email = ?, nacimiento = ?, passwd = ? WHERE usuario = ?";
                    $tipos = "sisssss";
                    $parametros = array($nombre, (int) $telef, $dni, $email, $nacimiento, $passwd, $viejoUsuario);
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
