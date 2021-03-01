<?php
/*
  Date       : Novembre 2020
  Auteur     : Aliya Myaz
  Sujet      : Page d'accueil du projet portfolio
 */
session_start();

$urlAVoler = FILTER_INPUT(INPUT_POST, "urlAVoler", FILTER_SANITIZE_STRING);
$submit = FILTER_INPUT(INPUT_POST, "btnSubmit", FILTER_SANITIZE_STRING);

if($submit){
  if($submit = "publier"){

  }
  else if($submit = "annuler"){
 
  }
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
            <input type="file" name="mediafiles[]" colspan="2" accept="image/*" multiple/>            
            <button type="submit" name="btnSubmit" value="publier">Publier</button>
          </td>
        </tr>
      </table>
    </form>

  </main>
  </body>
</html>
