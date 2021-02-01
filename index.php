<?php
/*
  Date       : Novembre 2020
  Auteur     : Aliya Myaz
  Sujet      : Page d'accueil du projet portfolio
 */

include("backend/autoload.php");
$urlAVoler = FILTER_INPUT(INPUT_POST, "urlAVoler", FILTER_SANITIZE_STRING);
if($submit){
    //si une url a été entrée dans formulaire
    if (!empty($urlAVoler)){
      //ajouter le site correspondant à l'url, avec son contenu, dans bd
      createPage($urlAVoler, LirePage($urlAVoler)[0], LirePage($urlAVoler)[1]);
    }
}
<td><input type="text" name="texte" colspan="2" placeholder="Veuillez entrer un texte" value="<?php echo $texte;?>"></td>
<td><button type="submit" name="btnSubmit" value="newText">Enregistrer</button></td>
</tr>

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  <nav>
    <a href="index.php">Poster</a>
  </nav>
  <main>
    <?php
    if($submit=="rechercher" || $submit=="rechercherExpans"){
      //afficher les résultats de la recherche dans un tableau
      AfficherResultats($pages, $critere);
    }
    if($submit =="rechercherRousseau"){
      AfficherResultatsBigDatas($pages, $critere);

    }
    ?>
  </main>
  </body>
</html>
