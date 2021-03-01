<?php
/*
  Date       : Octobre 2020
  Auteur     : Aliya Myaz
  Sujet      : Gestion de la table "note"
 */

//OK


function readMedias($idPost){
  static $ps = null;
  $sql = "SELECT *, DATE_FORMAT(`dateCreation`, '%d/%m/%Y %H:%i:%s') as dateCFormatee FROM media WHERE idPost = :idPost";

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

function createMedia($idPost, $type, $nom){
  static $ps = null;
  $sql = "INSERT INTO `media` (`idPost`, `type`, `nom`, `dateCreation`, `dateModification`) VALUES ( :idIdee, :idUser, :note, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':idPost', $idPost, PDO::PARAM_INT);
    $ps->bindParam(':type', $type, PDO::PARAM_STR);
    $ps->bindParam(':nom', $nom, PDO::PARAM_STR);

    $answer = $ps->execute();

    if($answer){
      echo "Le media a bien été ajouté";
    }
  }
  catch(PDOException $e){
    echo $e->getMessage();
    echo "Un problème est survenu lors de la création du media";
  }

  return $answer;
}

function deleteMedia($idMedia){
  static $ps = null;
  $sql = 'DELETE FROM media WHERE idMedia = :idMedia';

  if($ps == null){
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    $ps->bindParam(':idMedia', $idMedia, PDO::PARAM_INT);

    $answer = $ps->execute();
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }

  return $answer;
}
