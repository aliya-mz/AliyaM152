<?PHP
/*
  Date       : Octobre 2020
  Auteur     : Aliya Myaz
  Sujet      : Fonctions du projet
*/

//Limites de taille
define("MAX_IMAGE", 3000000);
define("MAX_POST", 70000000);

//Vérifier la validité des fichiers
function UploadPost(){  
  $tailleTotale = 0;
  //Raccourci d'écriture pour le tableau reçu
  $fichiers = $_FILES['mesFichiers'];
  //Parcourir les fichiers
  for($i=0;$i<count($fichiers['name']);$i++){
    if($fichiers['size'][$i] <= MAX_IMAGE && (preg_match('/image/',$fichiers['type'][$i]) || preg_match('/video/',$fichiers['type'][$i]) || preg_match('/audio/',$fichiers['type'][$i]))){      
      
      //Nettoyer le nom du fichier
      $nom_fichier = preg_replace('/[^a-z0-9\.\-]/i','',$fichiers['name'][$i]);

      //Vérifier si le nom existe déjà dans le répertoire, si oui en générer un nouveau
      if(file_exists('./backend/uploads/'.$nom_fichier)){
        $nom_fichier = (string)(rand()*10);
      }

      //Déplacement depuis le répertoire temporaire (problème de droits d'écriture)
      move_uploaded_file($fichiers['tmp_name'][$i],'./backend/uploads/'.$nom_fichier);
      
      //enregistrer le nom nettoyé et unique
      $fichiers['name'][$i] = $nom_fichier;

      //incrémenter la taille totale
      $tailleTotale += $fichiers['size'][$i];
    }
    else{
      $erreur = 'Problème avec le fichier '. $fichiers['name'][$i].'. Le fichier sélectionné doit être de type image et de taille inférieure à 3M';
      echo $erreur;
      return false;
    }  
  }

  //Vérifier la taille totale des médias
  if($tailleTotale >= MAX_POST){
    $erreur = 'Votre post est trop lourd. L\'ensemble de vos images ne doit pas peser plus de 70M';
    echo $erreur;
    return false;
  }

  //Retourner les fichiers du post
  return $fichiers;
}

//Enregistrer des données
function EnregistrerPost($commentaire, $fichiers){
  try {
    db()->beginTransaction();

    //Si les fichiers sont valables
    if($fichiers !== false){
      //Créer le nouveau post avec les données entrées par l'utilisateur
      createPost($commentaire);
      //Récupérer le post
      $lastPost = (ReadLastPost());
      echo $lastPost["MAX(idPost)"];
      //Parcourir les fichiers sélectionnés par l'utilisateur et les ajouter dans la BD, s'ils ont bien été ajoutés dans le dossier uploads
      for($i=0;$i<count($fichiers['name']);$i++){
        if(file_exists('./backend/uploads/'.$fichiers['name'][$i])){
          createMedia($lastPost["MAX(idPost)"], $fichiers['type'][$i], $fichiers['name'][$i]);
        }
      }
    }
    db()->commit();
      return true;
  } catch (Exception $e) {
    db()->rollBack();
    //si l'ajout dans la bd échoue, supprimer les fichiers dans le dossier
    for($i=0;$i<count($fichiers['name']);$i++){
      unlink('./backend/uploads/'.$fichiers['name'][$i]);
    }    
    return false;
  }  
}

//Afficher les posts (/!\ Afficher plusieurs medias)
function AfficherPosts($posts){
  //Créer un tableau qui contiendra les posts
  echo"<table class=\"conteneurPosts\">";
  //parcourir les posts
  foreach($posts as $post) {
    //récupérer dans la bd les médias du post
    $medias = readMediasByPost($post['idPost']);
    $numMedia = 0;
    $commentaire = $post["commentaire"];
    
    echo "<tr>"; 
    echo "<td class=\"caseBoutonsCenter\">";
    //bouton arrière
    echo "</td>";
    echo "<td rowspan='2' class=\"caseImage\" id=\"mediaBox".$post['idPost']."\">";

    //Afficher les médias
    if(count($medias)==1){
      AfficherMedia($medias[0]);
    }
    else{
      foreach($medias as $media){
        AfficherMedia($media);
      }
    }    
    
    echo "</td>";   
    echo "<td class=\"caseBoutonsCenter\">";
    //bouton avant
    echo "</td>";
    echo "<td class=\"caseCommentaire\">";
    //affichage du commentaire
    echo "<p>". $post["commentaire"] ."</p>";
    echo "</td>";
    echo "</td>";   
    echo "<td class=\"caseBoutons\">";
  }
  echo"</table>";
}

//Afficher carrousel post
function AfficherCarrousel($idPost, $medias){
  echo '<div id="_'. $idPost.'" class="carousel slide" data-bs-ride="carousel" data-interval="false">';
  echo ' <div class="carousel-inner">';

  //parcourir les médias du post et les afficher
  for ($i = 0; $i <  count($medias); $i++) {
      echo '<div class="carousel-item">';
      AfficherMedia($medias[$i]);
      echo '</div>';
    }
    echo ' </div>';
    echo ' <button class="carousel-control-prev" type="button" data-bs-target="#_'.$idPost.'"  data-bs-slide="prev">';
    echo '  <span class="carousel-control-prev-icon" aria-hidden="true"></span>';
    echo '  <span class="visually-hidden" style="color: black;"></span>';
    echo ' </button>';

    echo ' <button class="carousel-control-next" type="button" data-bs-target="#_'.$idPost.'"data-bs-slide="next">';
    echo '  <span class="carousel-control-next-icon" aria-hidden="true"></span>';
    echo '  <span class="visually-hidden"></span>';
    echo ' </button>';
    echo '</div>';
}

//Afficher un média un fonction de son type
function AfficherMedia($media){  
    //affichage du média en fonction du type
    if(strpos($media['type'], "image") !== false){
      echo "<img class=\"mediaPost\" src=\"backend/uploads/".$media['nom']."\"/>";
    }   
    else if(strpos($media['type'], "video")!== false){
      echo "<video class=\"mediaPost\" autoplay muted loop> <source  src=\"backend/uploads/".$media['nom']."\" /></video>";
    }
    else if(strpos($media['type'], "audio")!== false){
      echo "<audio class=\"mediaPost\" controls preload=\"auto\"> <source src=\"backend/uploads/".$media['nom']."\" /></audio>";
    }
}

//Afficher le formulaire de modification
function AfficherFormUpdate($post, $medias){
  echo "<br/>Modifier le commentaire<br/>";
  echo "<textarea class=\"petitInput\" type=\"text\" name=\"commentairen\">".$post['commentaire']."</textarea>";

  echo "<br/>Ajouter des medias<br/>";
  echo "<input type=\"file\" name=\"mesFichiers[]\" colspan=\"2\" accept=\"audio/*,video/*,image/*\" multiple/>";

  echo "<br/>Selectionner les médias à supprimer<br/>";
  echo "<select class=\"petitInput\" name =\"medias[]\" id=\"mediass\" multiple/>";
  //Afficher les medias dans une liste déroulante
  foreach($medias as $media) {
    echo "<option value =\"".$media['idMedia']."\">" . $media['nom'] . "</option>";
  }
  echo "</select>";

  //création du input pour valider les modifications
  echo "<button class=\"petitInput btnSubmit\" type=\"submit\" name=\"action\" value=\"annuler\">Annuler</button>";
  echo "<button class=\"petitInput btnSubmit\" type=\"submit\" name=\"action\" value=\"enregistrer\">Valider les modifications</button>";
}

//Supprimer le fichier et l'enregistrement dans la BD du post
function SupprimerPost($idPost){
  try {
    db()->beginTransaction();

    //Récupérer les médias du post 
    $medias = readMediasByPost($idPost);
    //Supprimer le post (et tous ses medias) de la bd
    DeletePost($idPost);

    db()->commit();    

    //Puisque tout s'est bien passé, supprimer du dossier les medias du post
    for($i=0;$i<count($medias);$i++){
      if(file_exists('./backend/uploads/'.$medias[$i]['nom'])){
        //Supprimer du dossier
        unlink('./backend/uploads/'.$medias[$i]['nom']);
      }
    }    

    return true;
  } catch (Exception $e) {
    db()->rollBack();
    return false;
  }
}

/*EN COURS*/
//Faire les modifications de fichiers et de commentaire
function ModifierPost($idPost, $commentaire, $fichiersS, $fichiersA){
  try {
    db()->beginTransaction();
    //Modifer le post de la BD
    updatePost($idPost, $commentaire);
    //Supprimer et ajouter les médias modifiés par l'utilisateur
    foreach($fichiersS as $fichierS){
      //supprimer du dossier
      unlink('./backend/uploads/'. $_SESSION["posts"][$idPost]["name"]);
      //supprimer de la BD
      deleteMedia($fichierS["idMedia"]);
    }
    foreach($fichiersA as $fichierS){
      //ajouter à la BD
      if(file_exists('./backend/uploads/'.$fichier['name'])){
        createMedia($idPost, $typeMedia, $nom);
      }      
    }
    db()->commit();
      return true;
  } catch (Exception $e) {
    db()->rollBack();
    //si l'ajout dans la bd échoue, supprimer les nouveaux fichiers ajoutés lors de la modification
    for($i=0;$i<count($fichiersA['name']);$i++){
      unlink('./backend/uploads/'.$fichiersA['name'][$i]);
    }
    return false;
  }    
}

//Recuperer les noms de chaque média d'un post
function GetNomsMedias($idPost){
  $medias = readMediasByPost($idPost);
  $nomsMedias = [];
  for($i = 0; $i <= count($medias); $i++){
    $nomMedias[$i] = "./backend/uploads/".$medias[$i]["nom"];
  }
  return $nomsMedias;
}