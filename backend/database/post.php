<?php
/*
  Date       : Octobre 2020
  Auteur     : Aliya Myaz
  Sujet      : Gestion de la table "note"
 */

//OK

function readPost($idPost){
  static $ps = null;
  $sql = "SELECT *, DATE_FORMAT(`dateCreation`, '%d/%m/%Y %H:%i:%s') as dateCFormatee, DATE_FORMAT(`dateModification`, '%d/%m/%Y %H:%i:%s') as dateMFormatee FROM post, media WHERE post.idPost = :idPost AND media.idPost = :idPost";

  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':idPost', $idPost, PDO::PARAM_INT);

    if($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
  return $answer;
}

function createPost($commentaire){
  static $ps = null;

  $sql = "INSERT INTO `post` (`commentaire`, `dateCreation`, `dateModification`) VALUES (:commentaire, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);

    $answer = $ps->execute();
    echo "Le post a bien été créé";
  }
  catch(PDOException $e){
    echo $e->getMessage();
    echo "Un problème est survenu lors de la création du post";
  }

  return $answer;
}

function updatePost($idPost, $commentaire){
  static $ps = null;

  //ajouter la date de modification
  $sql = 'UPDATE post SET commentaire = :commentaire, dateModification = CURRENT_TIMESTAMP WHERE idPost = :idPost';

  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':idPost', $idPost, PDO::PARAM_INT);
    $ps->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);

    $answer = $ps->execute();
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }

  return $answer;
}

function deletePost($idPost){
  static $ps = null;
  $sql = 'DELETE FROM post WHERE idPost = :idPost';

  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':idPost', $idPost, PDO::PARAM_INT);

    $answer = $ps->execute();
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }

  return $answer;
}
