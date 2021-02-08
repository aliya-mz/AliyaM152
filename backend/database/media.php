<?php
/*
  Date       : Octobre 2020
  Auteur     : Aliya Myaz
  Sujet      : Gestion de la table "note"
 */

function readNoteByIdeeIdAndUser($idIdee, $idUser){
  //initaliser le prepare statement
  static $ps = null;
  //requête
  $sql = "SELECT * FROM annoter WHERE idUser = :idUser AND idIdee = :idIdee";

  //si le prepare statement n'a encore jamais été fait
  if($ps == null){
    //préparer la requête
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    //lier le paramètre dans la requête avec la variable
    $ps->bindParam(':idIdee', $idIdee, PDO::PARAM_INT);
    $ps->bindParam(':idUser', $idUser, PDO::PARAM_INT);

    if($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
  return $answer;
}

function createNote($idIdee, $idUser, $note){
  //initaliser le prepare statement
  static $ps = null;
  //requête
  $sql = "INSERT INTO `annoter` (`idIdee`, `idUser`, `note`) VALUES ( :idIdee, :idUser, :note)";

  //si le prepare statement n'a encore jamais été fait
  if($ps == null){
    //préparer la requête
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    //lier le paramètre dans la requête avec la variable
    $ps->bindParam(':idIdee', $idIdee, PDO::PARAM_INT);
    $ps->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $ps->bindParam(':note', $note, PDO::PARAM_STR);

    $answer = $ps->execute();
    echo "La note a bien été créée";
  }
  catch(PDOException $e){
    echo $e->getMessage();
    echo "Un problème est survenu lors de la création de la note";
  }

  return $answer;
}

function updateNote($idNote, $note){
  //initaliser le prepare statement
  static $ps = null;
  //requête
  $sql = 'UPDATE annoter SET note = :note WHERE idnote = :idNote';

  //si le prépare statement n'a encore jamais été fait
  if($ps == null){
    //préparer la requête
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    //lier le paramètre dans la requête avec la variable
    $ps->bindParam(':idNote', $idNote, PDO::PARAM_INT);
    $ps->bindParam(':note', $note, PDO::PARAM_STR);

    $answer = $ps->execute();
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }

  return $answer;
}

function deleteNote($idNote){
  //initaliser le prepare statement
  static $ps = null;
  //requête
  $sql = 'DELETE FROM annoter WHERE idnote = :idNote';

  //si le prepare statement n'a encore jamais été fait
  if($ps == null){
    //préparer la requête
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try{
    //lier le paramètre dans la requête avec la variable
    $ps->bindParam(':idNote', $idNote, PDO::PARAM_INT);

    $answer = $ps->execute();
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }

  return $answer;
}
