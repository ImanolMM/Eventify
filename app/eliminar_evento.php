<?php
    // https://www.freecodecamp.org/news/creating-html-forms/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_COOKIE["user"])){
            $usuario = $_COOKIE["user"];

        }else{
            $usuario = "invitado";
        }
        $titulo = $_POST["titulo"];

        $hostname = "db";
        $username = "admin";
        $password = "test";
        $db = "database";

        $conn = mysqli_connect($hostname,$username,$password,$db); 
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