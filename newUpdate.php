<?php
/*
  Date       : Novembre 2020
  Auteur     : Aliya Myaz
  Sujet      : Page de modification de post
 */

/*PAGE EN COURS*/

include("backend/autoload.php");
session_start();

//Récupérer le post à modifier
$idPost = $_GET['idPost'];
$post = readPostById($idPost);
$medias = readMediasByPost($idPost);

//Récupérer les modifications
$mediasASupprimer = FILTER_INPUT(INPUT_POST, "mediass", FILTER_SANITIZE_STRING);
$commentaireN = FILTER_INPUT(INPUT_POST, "commentairen", FILTER_SANITIZE_STRING);
$action = FILTER_INPUT(INPUT_POST, "action", FILTER_SANITIZE_STRING);

if($action){
  if($action == "annuler"){
    //retourner à la page d'accueil
    header('location: index.php');
    exit();
  }
  else if($action == "enregistrer"){
    //si le post contient un commentaire
    if($commentaireN){
      var_dump($mediasASupprimer);
      ModifierPost($idPost, $commentaireN, $mediasASupprimer, UploadPost());
      //retourner à la page d'accueil
      //header('location: index.php');
      //exit();
    }
  }
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset=UTF-8>
        <title>Modifier un post</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"><!-- Bootstrap CSS  -->
    </head>
    
    <body>
      <nav>
      </nav>
      <main>
        <form action="newUpdate.php?idPost=<?=$post["idPost"]?>" method="post" enctype="multipart/form-data">
          <?php
            AfficherFormUpdate($post, $medias);
           ?>
        </form>
      </main>
    </body>
</html>
