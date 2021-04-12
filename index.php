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

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">    
   <!-- Bootstrap CSS  -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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

  <!-- Bootstrap JS  -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> -->
  </body>
</html>




