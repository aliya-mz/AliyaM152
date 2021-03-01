<?PHP
/*
  Date       : Octobre 2020
  Auteur     : Aliya Myaz
  Sujet      : Fonctions du projet
*/

//Vérifier la validité des fichiers
function UploadPost(){  
  //Raccourci d'écriture pour le tableau reçu
  $fichiers = $_FILES['mesfichiers'];
  //Parcourir les fichiers
  for($i=0;$i<count($fichiers['name']);$i++){
    if($fichiers['size'][$i]<2000000){
      // Nettoyage du nom de fichier
      $nom_fichier = preg_replace('/[^a-z0-9\.\-]/
      i','',$fichiers['name'][$i]);
      //Déplacement depuis le répertoire temporaire
      move_uploaded_file($fichiers['tmp_name'][$i],'uploads/
      '.$nom_fichier);
      //Si le type MIME correspond à une image, on l’affiche
      if(preg_match('/image/',$fichiers['type'][$i])) {
      }
    }
    else{
      $erreur = 'Veuillez uploader une image de taille inférieure à 2G';
      echo $erreur;
    }  
  }
}

//enregistrer des données
function EnregistrerPost($commentaire, $fichiers){
  //Créer le nouveau post avec les données entrées par l'utilisateur
  createPost($commentaire);
  //Parcourir les fichiers sélectionnés par l'utilisateur
  for($i=0;$i<count($fichiers['name']);$i++){
    createMedia(ReadLastPost(), $fichiers['type'][$i], $fichiers['name'][$i]);
  }
}

//Affichage des posts (CHAPITRE 3)
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