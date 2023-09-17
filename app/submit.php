<?php
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
}
?>