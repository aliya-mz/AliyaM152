<?php/*
  Date       : Novembre 2020
  Auteur     : Aliya Myaz
  Sujet      : Page d'accueil du projet portfolio
 */

/*PAGE A FAIRE*/

//Récupérer le post à modifier
$idPost = $_GET['idPost'];

$commentaireN = FILTER_INPUT(INPUT_POST, "commentairen", FILTER_SANITIZE_STRING);
$mediasN = FILTER_INPUT(INPUT_POST, " mediasn", FILTER_SANITIZE_STRING);

$action = FILTER_INPUT(INPUT_POST, "action", FILTER_SANITIZE_STRING);

$post = readPostById($idPost);
$medias = GetNomsMedias($idPost);

if($action == "annuler"){
  // retourner à la page d'accueil
  header('location: index.php');
  exit();
}
else if($action == "enregistrer"){
  // si tous les champs sont remplis
  if($commentaireN && $mediasN){
    ModifierPost($commentaireN, $mediasASupprimer, $mediasAAjouter);
    //retourner à la page d'accueil
    header('location: index.php');
    exit();
  }
}

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset=UTF-8>
        <title>Modifier un livre</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
      <nav class="navEnd">
        <a class="lienBouton btnNav" href="index.php"><span>Gestion des livres</span></a>
      </nav>

      <main>
        <form class="formGestionLivre" action="modifierLivre.php?idLivre=<?=$idpOST?>" method="post">
          <?php
            echo "<br/>Modifications : <br/>";
            echo "<input class=\"petitInput\" type=\"text\" name=\"commentairen\" value=\"".$post['commentaire']."\"></input>";
            echo "<input type=\"file\" name=\"mediasn[]\" colspan=\"2\" accept=\"audio/*,video/*,image/*\" multiple/>";

            //création du input pour valider les modifications
            echo "<button class=\"petitInput btnSubmit\" type=\"submit\" name=\"action\" value=\"annuler\">Annuler</button>";
            echo "<button class=\"petitInput btnSubmit\" type=\"submit\" name=\"action\" value=\"enregistrer\">Valider les modifications</button>";

            //si on clique sur "enregistrer les modifications"
            if(isset($_POST["valider"])){
              echo "</br>Les modifications ont bien été enregistrées";
            }
          ?>

        </form>
      </main>
    </body>
</html>
