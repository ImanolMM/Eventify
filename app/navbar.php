<?php
  // para incluir el navbar en una de las páginas php:
  // https://stackoverflow.com/questions/8450696/execute-a-php-script-from-another-php-script
  
  if(isset($_COOKIE["user"])){
    $link = "/logout.php";
    $texto = "Cerrar sesión";
    $textoPerfil = "Perfil";
  }else{
    $link = "/login.php";
    $texto = "Iniciar sesión";
    $textoPerfil = "";
  }
  $navbar = '
  <link rel="stylesheet" href="styles.css">
  <div class="navbar">
  <ul>
    <li>
      <a class="linkInicio" href="/">Inicio</a>
      <a class="linkInicio" href="/crearEvento.php">Crear Evento</a>
      <a class="linkInicio" href="/editarPost.php">Editar Evento</a>
    </li>
    <li>
      <a class="linkLogin" href="/perfil.php">'.$textoPerfil.'</a>
      <a class="linkLogin" href='.$link.'>'.$texto.'</a>
    </li>
  </ul>
  </div>';

  echo $navbar;
?>
