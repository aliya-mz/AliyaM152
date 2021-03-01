<?PHP
/*
  Date       : Octobre 2020
  Auteur     : Aliya Myaz
  Sujet      : Fonctions du projet
*/

//enregistrer les données
function EnregistrerPost(){
  //Vérifier la taille des images et du post
  if(verif)

  $_FILES[‘img']['name'] //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).

$_FILES[‘img']['type'] //Le type du fichier. Par exemple, cela peut être « image/png ».
z
$_FILES[‘img']['size'] //La taille du fichier en octets.

$_FILES[‘img']['tmp_name'] //L'adresse vers le fichier uploadé dans le répertoire temporaire.

$_FILES[‘img']['error'] //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.
}

//Affichage des posts
/*
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
*/