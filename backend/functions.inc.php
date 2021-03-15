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
    if($fichiers['size'][$i] <= MAX_IMAGE && preg_match('/image/',$fichiers['type'][$i])){      
    
      //Nettoyage du nom de fichier
      $nom_fichier = preg_replace('/[^a-z0-9\.\-]/i','',$fichiers['name'][$i]);

      //Vérifier si le nom existe déjà dans le répertoire, si oui en générer un nouveau
      if(file_exists('.backend/uploads/'.$nom_fichier)){
        $nom_fichier = (string)(rand()*10);
      }

      //Déplacement depuis le répertoire temporaire (problème de droits d'écriture)
      var_dump(move_uploaded_file($fichiers['tmp_name'][$i],'./backend/uploads/'.$nom_fichier));
      
      $tailleTotale += $fichiers['size'][$i];
    }
    else{
      $erreur = 'Problème avec le fichier '. $fichiers['name'][$i].'. Le fichier sélectionné doit être de type image et de taille inférieure à 3M';
      echo $erreur;
    }  
  }

  //Vérifier la taille totale des médias
  if($tailleTotale >= MAX_POST){
    $erreur = 'Votre post est trop lourd. L\'ensemble de vos images ne doit pas peser plus de 70M';
    echo $erreur;
  }

  //Retourner les fichiers du post
  return $fichiers;
}

//Enregistrer des données (/!\)
function EnregistrerPost($commentaire, $fichiers){
  //Créer le nouveau post avec les données entrées par l'utilisateur
  createPost($commentaire);
  //Récupérer le post
  $lastPost = (ReadLastPost());
  echo $lastPost["MAX(idPost)"];
  //Parcourir les fichiers sélectionnés par l'utilisateur et les ajouter dans la BD
  for($i=0;$i<count($fichiers['name']);$i++){
    createMedia($lastPost["MAX(idPost)"], $fichiers['type'][$i], $fichiers['name'][$i]);
  }

  // /!\ Faire les transactions
  //https://www.php.net/manual/fr/pdo.begintransaction.php
}

//Afficher les posts (partie fonctionnelle ok, /!\ visuel pas ok)
function AfficherPosts($posts){
  //Créer un tableau qui contiendra les posts
  echo"<table>";

  //parcourir les posts
  foreach($posts as $post) {
    //récupérer dans la bd les médias du post
    $medias = readMediasByPost($post['idPost']);
    $numMedia = 0;
    $commentaire = $post["commentaire"];
    var_dump($medias[0]);

    echo "<tr>"; 
    echo "<td rowspan = \"2\">";
    //affichage du média
    echo "<img src=\"backend/uploads/".$medias[0]['nom']."\"/>";
    echo "</td>";    
    echo "<td>";
    //affichage du commentaire
    echo "<p>". $post["commentaire"] ."</p>";
    echo "</td>";
    echo "</tr>"; 
    echo "<tr>";
    echo "<td>";
    //affichage des boutons
    echo "<button type=\"submit\" name=\"modifier\" value=\"".$post['idPost']."\"><img class=\"iconButton\" src=\"img/modifier.png\"/></button>";
    echo "<button type=\"submit\" name=\"supprimer\" value=\"".$post['idPost']."\"><img class=\"iconButton\" src=\"img/supprimer.png\"/></button>";
    echo "</td>";
    echo "</tr>";
  }
  echo"</table>";
}
