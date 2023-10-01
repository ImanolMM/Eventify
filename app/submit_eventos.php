<?php
            // https://www.freecodecamp.org/news/creating-html-forms/
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_COOKIE["user"])){
                    $usuario = $_COOKIE["user"];

                }else{
                    $usuario = "invitado";
                }
                $viejoTitulo = $_POST["viejoTitulo"];
                $titulo = $_POST["titulo"];
                $enunciado = $_POST["enunciado"];
                $opcion1 = $_POST["opcion1"];
                $resultado1 = $_POST["resultado1"];
                $opcion2 = $_POST["opcion2"];
                $resultado2 = $_POST["resultado2"];
                $es_edit = $_POST["flagedit"];

                $hostname = "db";
                $username = "admin";
                $password = "test";
                $db = "database";

                $conn = mysqli_connect($hostname,$username,$password,$db); 
                if ($conn->connect_error) {
                die("Database connection failed: " . $conn->connect_error);
                }

                if($es_edit != "edit"){
                    $consulta = "INSERT INTO eventos VALUES(?, ?, ?, ?, ?, ?, ?)";
                    $tipos = "sssssss";
                    $parametros = array($usuario, $titulo , $enunciado, $opcion1, $resultado1, $opcion2, $resultado2);
                    $mensaje = "Evento creado";

                }else{
                    $consulta = "UPDATE eventos SET titulo = ?, enunciado = ?, opcion1 = ?, resultado1 = ?, opcion2 = ?, resultado2 = ? WHERE titulo = ? AND usuario = ?";
                    $tipos = "ssssssss";
                    $parametros = array($titulo , $enunciado, $opcion1, $resultado1, $opcion2, $resultado2, $viejoTitulo, $usuario);
                    $mensaje = "Evento editado";
                }


                if($stmt = mysqli_prepare($conn, $consulta)){
                        $stmt->bind_param($tipos, ...$parametros);
                        $stmt->execute();
                        $stmt->close();
                }else{
                    $mensaje = "error";
                }

             }else{
                header("Location: /"); // Redirigimos a inicio si no es post
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