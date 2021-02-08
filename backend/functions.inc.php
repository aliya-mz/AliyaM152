<?PHP
/*
  Date       : Octobre 2020
  Auteur     : Aliya Myaz
  Sujet      : Fonctions du projet
*/

/*
pouvoir mettre en favoris/enlever des favoris grâce au bouton
*/

//Affichage du tableau de notes récupérées dans la BD
function ideesToHtmlTable($idees, $mesIdees, $favoris){
    $note = "";

    echo "<tbody>";
    //afficher chaque idée, afficher chaque champs de l'idée
    foreach($idees as $idee) {
      //récupérer la note de l'idée
      $note = readNoteByIdeeIdAndUser($idee["idIdee"], $_SESSION["idUser"]);
      echo "<tr>";

          //fabrication du conteneur avec des flexbox
          echo "<td>";
          echo "<div class=\"conteneurIdee\">
          <div class=\"en-teteIdee\"><div>".$idee['titre']."</div><div>".$idee['dateFormatee']."</div></div>
          <div class=\"corpsIdee\">
          <div id=\"categorie\">Catégorie :".readCategorieById($idee['idCategorie'])["nom"]."</div>
          <div id=\"description\">".$idee['descriptionIdee']."</div>
          <div id=\"tags\">";
          //afficher tous les tags
          $tags = getTagsById($idee['idIdee']);
          foreach ($tags as $tag) {
            echo "<label class=\"taglabel\">".$tag["mot"]."</label>";
          }
          echo "</div></div>";          
          
          if(!$mesIdees){
            echo "<div class=\"actionsIdee\">";
            //vérifier si cette idée est dans les favoris de l'utilisateurs et adapter en fonction
            if(ideeEstFavoris($idee['idIdee'])){
              //mettre en favoris
              echo "<button type=\"submit\" name=\"mettreEnFavoris\" value=\"".$idee['idIdee']."\"><img class=\"iconButton\" src=\"img/favorisOui.png\"/></button>";
            }
            else{
              //mettre en non-favoris
              echo "<button type=\"submit\" name=\"mettreEnFavoris\" value=\"".$idee['idIdee']." \"><img class=\"iconButton\" src=\"img/favorisNon.png\"/></button>";
            } 
            echo "</div></div></td>";    
          }
          else{
            echo "<div class=\"actionsIdee\"><button type=\"submit\" title=\"".$note["note"]."\" name=\"annoter\" value=\"".$idee['idIdee']."\">Annoter</button>";
            //si on est dans la colonne des favoris, afficher le bouton permettant de mettre en favoris 
            if($favoris){
              echo "<button type=\"submit\" name=\"mettreEnFavoris\" value=\"".$idee['idIdee']."\"><img class=\"iconButton\" src=\"img/favorisOui.png\"/></button>";
            }
            echo "</div></div></td>";
          }          

        echo "</tr>";
      }
    echo "</tbody>";
}

function changerEtatFavoris($idIdee){
  //si l'idée est déjà dans les favoris
  if(ideeEstFavoris($idIdee)){
    //supprimer l'enregistrement de mise en favoris dans la BD
    deleteFavoris($idIdee, $_SESSION["idUser"]);
  }
  //sinon
  else{
    //créer l'enregistrement de favoris
    createFavoris($idIdee, $_SESSION["idUser"]);
  }
}

function ideeEstFavoris($idIdee){
  $estFavoris = false;
  $estFavoris = readFavorisByIdea($idIdee, $_SESSION["idUser"]);
  return $estFavoris;
}

//Affichage de la liste déroulante des catégories
function categorieToSelect($categories, $categorieSelect){
  //afficher le select
  echo "<select name=\"categorie\">";
  //pour chaque branche
  foreach($categories as $categorie){

    //si la branche est celle sélecionnée précédemment (sticky)
    if($categorie["idCategorie"] == $categorieSelect){
      echo "<option value=\"".$categorie["idCategorie"]."\" selected>".$categorie["nom"]."</option>";
    }
    //sinon
    else{
      echo "<option value=\"".$categorie["idCategorie"]."\">".$categorie["nom"]."</option>";
    }
  }
  echo "</select>";
}

function AjouterTagsIdee($tags, $idIdee){
  //ajouter chaque tag de l'idée dans la BD
  foreach($tags as $tag){
    CreateTag($tag, $idIdee);
  }
}

function VerifierAccessibilite($connecte){
  //$connecte = true => permettre aux personnes connectées
  if($connecte){
    //tester si on doit pouvoir accéder à cette page
    if(!isset($_SESSION["idUser"])){
      //erreur, utilisateur déconnecté, renvoyer sur la page d'accueil
      header('Location: index.php');
      exit;
    }
  }
  else{
    //tester si on doit pouvoir accéder à cette page
    if(isset($_SESSION["idUser"])){
      //erreur, utilisateur déconnecté, renvoyer sur la page d'accueil
      header('Location: index.php');
      exit;
    }
  }

}
