<?php
// https://www.freecodecamp.org/news/creating-html-forms/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nombre = $_POST["nombre"];
    $telef = $_POST["telefono"];
    $dni = $_POST["dni"];
    $email = $_POST["email"];
    $nacimiento = $_POST["nacimiento"];
    $usuario = $_POST["usuario"];
    $passwd = $_POST["passwd"];

    // Display the submitted data
    echo "Name: " . $nombre . "<br>";
    echo "Email: " . $telef . "<br>";
    echo "dni: " . $dni . "<br>";
    echo "email: " . $email . "<br>";
    echo "nacimiento: " . $nacimiento . "<br>";
    echo "usuario: " . $usuario . "<br>";
    echo "passwd: " . $passwd . "<br>";

    // phpinfo();
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
    }



    $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE nombre = '" . $nombre ."'")
        or die (mysqli_error($conn));

    $existeUsuario = false;

    while ($row = mysqli_fetch_array($query)) {
        $existeUsuario = $existeUsuario && ($row['usuario'] == $usuario);
    }

    if(!$existeUsuario){
        $query = mysqli_query($conn, "INSERT INTO usuarios(nombre) VALUES('" . $nombre ."')")
        or die (mysqli_error($conn));
        echo "Usuario creado";
    }
    
}
?>