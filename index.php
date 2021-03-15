<?php
/*
  Date       : Novembre 2020
  Auteur     : Aliya Myaz
  Sujet      : Page d'accueil du projet portfolio
 */

include("backend/autoload.php");
session_start();

//récupérer les posts dans la bd
$posts = ReadPosts();
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
    <a href="newPost.php">Poster</a>
  </nav>
  <main>
    <?php
      //afficher les posts
      AfficherPosts($posts);
    ?>
  </main>
  </body>
</html>
