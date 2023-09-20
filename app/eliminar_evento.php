<?php
//edfoi
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST["titulo"];
        if(isset($_COOKIE["user"])){
            $usuario = $_COOKIE["user"];

        }else{
            $usuario = "invitado";
        }

        $hostname = "db";
        $username = "admin";
        $password = "test";
        $db = "database";

        $conn = mysqli_connect($hostname,$username,$password,$db); 
        if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
        }

        $consulta = "DELETE * FROM eventos WHERE titulo = ? AND usuario = ?";
        $tipos = "ss";
        $parametros = array($titulo, $usuario);
        if($stmt = mysqli_prepare($conn, $consulta)){
                $stmt->bind_param($tipos, ...$parametros);
                $stmt->execute();
                $stmt->close();
        }

    }
?>