<?php
/*
  Date       : Novembre 2020
  Auteur     : Aliya Myaz
  Sujet      : Page d'accueil du projet portfolio
 */

//include("backend/autoload.php");

session_start();

$urlAVoler = FILTER_INPUT(INPUT_POST, "urlAVoler", FILTER_SANITIZE_STRING);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  <nav>
    <a href="post.php">Poster</a>
  </nav>
  <main>
    <?php
    
    ?>
  </main>
  </body>
</html>
