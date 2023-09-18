<?php
            // https://www.freecodecamp.org/news/creating-html-forms/
            echo("alo");
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo "llega";
                if(isset($_COOKIE["user"])){
                    $usuario = $_COOKIE["user"];

                }else{
                    $usuario = "invitado";
                }
                $titulo = $_POST["titulo"];
                $enunciado = $_POST["enunciado"];
                $opcion1 = $_POST["opcion1"];
                $resultado1 = $_POST["resultado1"];
                $opcion2 = $_POST["opcion2"];
                $resultado2 = $_POST["resultado2"];

                $hostname = "db";
                $username = "admin";
                $password = "test";
                $db = "database";

                $conn = mysqli_connect($hostname,$username,$password,$db); 
                if ($conn->connect_error) {
                die("Database connection failed: " . $conn->connect_error);
                }

                $consulta = "INSERT INTO eventos VALUES(?, ?, ?, ?, ?, ?, ?)";
                    $tipos = "sssssss";
                    $parametros = array($usuario,$titulo , $enunciado, $opcion1, $resultado1, $opcion2, $resultado2);
                    if($stmt = mysqli_prepare($conn, $consulta)){
                            $stmt->bind_param($tipos, ...$parametros);
                            $stmt->execute();
                            $stmt->close();
                            $mensaje = "Evento creado";
                    }else{
                        $mensaje = "error";
                    }
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