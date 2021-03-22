<?php
/*PAGE A FAIRE*/

//Récupérer le post à modifier
$idPost = $_GET['idPost'];

$commentaireN = FILTER_INPUT(INPUT_POST, "auteurn", FILTER_SANITIZE_STRING);
$mediasN = FILTER_INPUT(INPUT_POST, "action", FILTER_SANITIZE_STRING);

$post = readPostById($idSelectedBook);
$medias = readMediasByPost($idPost);

if($action == "annuler"){
  // retourner à la page d'accueil
  header('location: index.php');
  exit();
}
else if($action == "enregistrer"){
  // si tous les champs sont remplis
  if($commentaireN && $mediasN){
    //enregistrer les changements
    //updatePost($idModifiedBook, $auteurN, $titreN, $anneeN, $idCategorieN);
    // retourner à la page d'accueil
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
        <form class="formGestionLivre" action="modifierLivre.php?idLivre=<?=$idSelectedBook?>" method="post">
          <?php
            echo "<br/>Modifications : <br/>";
            echo "<input class=\"petitInput\" type=\"text\" name=\"idn\" value=\"".$livre['id']."\" readonly=\"readonly\"></input>";
            echo "<input class=\"petitInput\" type=\"text\" name=\"auteurn\" value=\"".$livre['auteur']."\"></input>";
            echo "<input class=\"petitInput\" type=\"text\" name=\"titren\" value=\"".$livre['titre']."\"></input>";
            echo "<input class=\"petitInput\" type=\"text\" name=\"anneen\" value=\"".$livre['annee']."\"></input>";

            echo "<select class=\"petitInput\" name =\"categorien\" id=\"categorie\" required\>";
            //Afficher les catégorie dans une liste déroulante
            foreach($categories as $categorie) {
              echo "<option value =\"".$categorie['idCategorie']."\">" . $categorie['nomCategorie'] . "</option>";
            }
            echo "</select>";

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
