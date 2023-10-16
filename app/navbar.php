<?php
  // para incluir el navbar en una de las páginas php:
  // https://stackoverflow.com/questions/8450696/execute-a-php-script-from-another-php-script
  ini_set('display_errors', 0);
  if(isset($_COOKIE["user"]) && $_COOKIE["user"] != "invitado"){
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
