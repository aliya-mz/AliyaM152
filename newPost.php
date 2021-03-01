<?php
/*
  Date       : Novembre 2020
  Auteur     : Aliya Myaz
  Sujet      : Page d'accueil du projet portfolio
 */

session_start();

$commentaire = FILTER_INPUT(INPUT_POST, "commentaire", FILTER_SANITIZE_STRING);
$submit = FILTER_INPUT(INPUT_POST, "btnSubmit", FILTER_SANITIZE_STRING);

//Gestion d'envoi de formlaire
if($submit){
  if($submit = "publier"){
    EnregistrerPost($commentaire)
  }
  else if($submit = "annuler"){
 
  }
}

//Quand on sélectionne des dossiers
if(isset($_FILES) && is_array($_FILES) && count($_FILES)>0) {
  UploadPost();
}  

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
    <a href="index.php">Home</a>
  </nav>
  <main>

    <form method="post" action="post.php" enctype="multipart/form-data">
      <table>
        <tr>
          <td>
            <div class="takeAllWidth">
              <textarea name="commentaire" placeholder="Ecris quelque chose..." rows="4" cols="50"></textarea>
            </div>
            <div class="verticalFlex">
              <button class="smallBtn" type="submit" name="annuler" value="annuler">X</button>
              <button class="smallBtn" name="partager" value="partager">-></button>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <input type="file" name="mesFichiers[]" colspan="2" accept="image/*" multiple/>            
            <button type="submit" name="btnSubmit" value="publier">Publier</button>
          </td>
        </tr>
      </table>
    </form>

  </main>
  </body>
</html>
