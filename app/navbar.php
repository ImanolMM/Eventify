<?php
  session_start();
  
  

  // para incluir el navbar en una de las páginas php:
  // https://stackoverflow.com/questions/8450696/execute-a-php-script-from-another-php-script
  function comprobarCookieUsuario($conn) {
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
        return false;
    } 
    elseif ($_COOKIE[$cookie_name] === "invitado") {
        return true;
    }
    else {
        $consulta_usuario = "SELECT usuario,sal FROM usuarios WHERE cookie = ?";
        $stmt = mysqli_prepare($conn, $consulta_usuario);
        mysqli_stmt_bind_param($stmt, "s", $usuario);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_array($result)) {
            $usuario = $row['usuario'];
            $sal = $row['sal'];
        }
        $usersal = $usuario . $sal;
        if (password_verify($usersal, $_COOKIE[$cookie_name])) {
            return true;
        } else {
            return false;
        }
    }
  }
  function getUsuarioCookie($conn){
    $hash=$_COOKIE["user"];
    //get the user from the database
    $consulta_usuario = "SELECT usuario,sal FROM usuarios WHERE cookie = ?";
    $stmt = mysqli_prepare($conn, $consulta_usuario);
    mysqli_stmt_bind_param($stmt, "s", $hash);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    //get usuario from databes with $result
    while ($row = mysqli_fetch_array($result)) {
      $usuario = $row['usuario'];
      $sal = $row['sal'];
    }
    return $usuario;
  }
  ini_set('display_errors', 0);
  $hostname = "db";
  $username = "admin";
  $password = "test";
  $db = "database";

  $conn = mysqli_connect($hostname,$username,$password,$db); 
  if(comprobarCookieUsuario($conn) && $_COOKIE["user"] != "invitado"){
    $perfil = '<a href="/perfil.php" class="material-symbols-outlined blanco">account_circle</a>';
    //cambiar el href de abajo para que redirija a logout.php
    $logOut = '<a href="logout.php"class="material-symbols-outlined blanco">logout</a>';
  }else{
    $perfil = '<a class="linkLogin" href=/login.php>Iniciar sesión</a>';
    $textoPerfil = "";
  }
  $navbar = '
  <link rel="stylesheet" href="styles.css">

  <!-- Fuente de letra roboto de Google  https://fonts.google.com/specimen/Roboto -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

  <!-- Iconos de Google  https://developers.google.com/fonts/docs/material_icons?hl=es-419 -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <div class="navbar">
  <ul>
    <div class="links">
      <a class="linkInicio" href="/">Inicio</a>
      <a class="linkInicio" href="/crearEvento.php">Crear Evento</a>
      <a class="linkInicio" href="/editarPost.php">Editar Evento</a>
    </div>
    <li>
      '.$perfil.'
      '.$logOut.'
    </li>
  </ul>
  </div>';

  echo $navbar;
?>
