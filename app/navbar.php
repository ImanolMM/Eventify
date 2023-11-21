<?php


  use Firebase\JWT\JWT;
  require_once('./vendor/autoload.php');

  // para incluir el navbar en una de las páginas php:
  // https://stackoverflow.com/questions/8450696/execute-a-php-script-from-another-php-script
  function comprobarCookieUsuario() {
    $usr = $_COOKIE("user");
    return isset($usr);
  }

  function getUsuarioCookie(){
    $jwt = $_COOKIE('user');
    $usr = "invitado";
    if($jwt !== "invitado"){
      $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mIQyzqaS74Q4oR1ew=';
      $token = JWT::decode($jwt, $secretKey, ['HS512']);
      $now = new DateTimeImmutable();

      if ($token->nbf > $now->getTimestamp() ||
          $token->exp < $now->getTimestamp())
      {
        setcookie("user", "invitado", time() + (720 * 60), "/"); // 720 minutos de duración
      }else{
        $usr = $token->data->userName;
      }
      return $usr;
    }
  }

  function setCookieUsuarioSegura($usuario) {
    $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mIQyzqaS74Q4oR1ew=';
    $tokenId    = base64_encode(random_bytes(16));
    $issuedAt   = new DateTimeImmutable();
    $expire     = $issuedAt->modify('+720 minutes')->getTimestamp();                                  

    // Create the token as an array
    $data = [
        'iat'  => $issuedAt->getTimestamp(),    // Issued at: time when the token was generated
        'jti'  => $tokenId,                     // Json Token Id: an unique identifier for the token
        'nbf'  => $issuedAt->getTimestamp(),    // Not before
        'exp'  => $expire,                      // Expire
        'data' => [                             // Data related to the signer user
            'userName' => $usuario,            // User name
        ]
    ];

    // Encode the array to a JWT string.
    $val = JWT::encode(
        $data,      //Data to be encoded in the JWT
        $secretKey, // The signing key
        'HS512'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
    );
    setcookie("user", $val, time() + (720 * 60), "/"); // 720 minutos de duración
        
  }

  ini_set('display_errors', 0);
  $hostname = "db";
  $username = "admin";
  $password = "test";
  $db = "database";

  $conn = mysqli_connect($hostname,$username,$password,$db); 
  if(comprobarCookieUsuario() && $_COOKIE["user"] !== "invitado"){
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
