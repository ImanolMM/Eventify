<?php
  // para incluir el navbar en una de las páginas php:
  // https://stackoverflow.com/questions/8450696/execute-a-php-script-from-another-php-script
  
  if(isset($_COOKIE["user"])){
    $perfil = '<a href="/perfil.php" class="material-symbols-outlined">account_circle</a>';
    //cambiar el href de abajo para que redirija a logout.php
    $logOut = '<a href="logout.php"class="material-symbols-outlined">logout</a>';
  }else{
    $perfil = '<a class="linkLogin" href=/login.php>Iniciar sesión</a>';
    $textoPerfil = "";
  }
  $navbar = '
  <link rel="stylesheet" href="styles.css">
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
