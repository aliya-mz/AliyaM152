<?php
/*
  Date       : Novembre 2020
  Auteur     : Aliya Myaz
  Sujet      : Page d'accueil du projet portfolio
 */

/*
RESTE A FAIRE :
- Update
- Delete à tester
- Update en Ajax
*/

include("backend/autoload.php");
session_start();

//Récupérer les posts dans la BD 
$_SESSION["posts"]= ReadPosts();

if(!isset($_SESSION["mediaPost"])){
  $_SESSION["mediaPost"]=[];
  for($i = 0; $i< count($_SESSION["posts"]); $i++){
    $_SESSION["mediaPost"][$i] = 0;
  }
}

$submitModifier = FILTER_INPUT(INPUT_POST, "btnModifier", FILTER_SANITIZE_STRING);
$submitSupprimer = FILTER_INPUT(INPUT_POST, "btnSupprimer", FILTER_SANITIZE_STRING);


//ces trucs ne sont jamais appelés
if($submitModifier){
  //Rediriger vers la page de modification du post sélectionné
  echo "pourquoi !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
  echo $submitModifier;
  header('Location: newUpdate.php?idPost='.$submitModifier);
  echo $submitModifier;
  exit();
}
else if($submitSupprimer){
  //Supprimer le post sélectionné
  SupprimerPost($submitSupprimer);
}
?>

<script>
  //Récupérer
  
</script>

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
  <form action="index.php" method="post">
    <?php
      //afficher les posts
      AfficherPosts($_SESSION["posts"]);
    ?>
  </form>
  </main>
  </body>
</html>