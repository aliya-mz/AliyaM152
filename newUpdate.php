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

echo "id post : ".$idPost;

$commentaireN = FILTER_INPUT(INPUT_POST, "commentairen", FILTER_SANITIZE_STRING);
$action = FILTER_INPUT(INPUT_POST, "action", FILTER_SANITIZE_STRING);

$post = readPostById($idPost);
$medias = GetNomsMedias($idPost);

if($action){
  if($action == "annuler"){
    //retourner à la page d'accueil
    header('location: index.php');
    exit();
  }
  else if($action == "enregistrer"){
    //si tous les champs sont remplis
    if($commentaireN && $mediasN){
      ModifierPost($idPost, $commentaireN, $mediasASupprimer, UploadPost());
      //retourner à la page d'accueil
      header('location: index.php');
      exit();
    }
  }
}
  echo $post;
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset=UTF-8>
        <title>Modifier un post</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    
    <body>
      <nav>
      </nav>
      <main>
        <form action="newUpdate.php?idPost=<?=$post["idPost"]?>" method="post">
          <?php
            AfficherFormUpdate($post, $medias);
          ?>
        </form>
      </main>
    </body>
</html>
