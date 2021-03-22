<?php
/*
  Date       : Novembre 2020
  Auteur     : Aliya Myaz
  Sujet      : Page d'accueil du projet portfolio
 */

/*
RESTE A FAIRE :
- Afficher plusieurs medias par post
- Update/delete
- Transactions update/delete
*/

include("backend/autoload.php");
session_start();

//Récupérer les posts dans la BD
$_SESSION["posts"]= ReadPosts();

if(!isset($_SESSION["mediaPost"])){
  $_SESSION["mediaPost"]=[];
  for($i = 0; $i< count($_SESSION["posts"]); $i++){
    $_SESSION["mediaPost"][$i] = 1;
  }
}

/*
$submitArriere = FILTER_INPUT(INPUT_POST, "btnArriere", FILTER_SANITIZE_STRING);
$submitAvant = FILTER_INPUT(INPUT_POST, "btnAvant", FILTER_SANITIZE_STRING);
*/

$submitModifier = FILTER_INPUT(INPUT_POST, "btnModifier", FILTER_SANITIZE_STRING);
$submitSupprimer = FILTER_INPUT(INPUT_POST, "btnSupprimer", FILTER_SANITIZE_STRING);

//Gestion d'envoi de formulaire
/*
if($submitArriere){
  //Afficher l'image suivante du post
  $_SESSION["mediaPost"][$submitArriere] += 1;

  //Vérifier qu'on ne dépasse pas les limites
  if($_SESSION["mediaPost"][0]>=count($_SESSION["posts"])){
    $_SESSION["mediaPost"][0] = count($_SESSION["posts"]) - 1;
  }  
}
else if($submitAvant){
  //Afficher l'image précédente du post
  $_SESSION["mediaPost"][$submitAvant] -= 1;

  //Vérifier qu'on ne dépasse pas les limites
  if($_SESSION["mediaPost"][0]<0){
    $_SESSION["mediaPost"][0] = 0;
  }
}
*/

//ces trucs ne sont jamais appelés
if($submitModifier){
  //Rediriger vers la page de modification du post sélectionné
  echo "pourquoi !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
  echo $submitModifier;
  header('Location: newUpdate.php&&idPost='.$submitModifier);
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
    <?php
      //afficher les posts
      AfficherPosts($_SESSION["posts"]);
    ?>
  </main>

  <script> 
  /*  
  //Faire défiler les médias en remplaçant le média affiché par le suivant ou le précédent (informations fournies par les paramètres)
  function ChangerMediaPost(idPost, nomMedia, type){  
    //affichage du média en fonction du type
    if($type == "image"){      
        document.getElementById("mediaBox"+idPost).innerHTML = "<img class=\"mediaPost\" src=\"backend/uploads/"+nomMedia+"\"/>";
    }   
    else if($type == "video"){
        document.getElementById("mediaBox"+idPost).innerHTML = "<video class=\"mediaPost\" autoplay muted loop> <source  src=\"backend/uploads/"+mediaName+"\" /></video>";
    }
    else if($type == "audio"){
        document.getElementById("mediaBox"+idPost).innerHTML = "<audio class=\"mediaPost\" controls preload=\"auto\"> <source src=\"backend/uploads/"+mediaName+"\" /></audio>";
    }
  } 
  */
  </script>
  </body>
</html>
