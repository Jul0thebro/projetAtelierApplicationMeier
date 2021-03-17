<?php
const DROIT_CAPITAINE = 2;
/*function verifyRolePlayers($email)
{
  static $ps = null;
  $sql = "SELECT droitsusers.nomDroit FROM players, droitsusers WHERE ";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':EMAIL', $email, PDO::PARAM_INT);
    if ($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}*/

function recupIdTeam()
{
  static $ps = null;
  $sql = "SELECT MAX(idEquipe) FROM equipes";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    if ($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $answer;
}

function recupIdPlayer($pseudo)
{
  static $ps = null;
  $sql = "SELECT idPlayer FROM players WHERE pseudo = :PSEUDO";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':PSEUDO', $pseudo, PDO::PARAM_STR);
    if ($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $answer;
}

function nbPlacesRestantes($id)
{
  static $ps = null;
  $sql = "SELECT Count(idEquipe) FROM equipes_tournoi WHERE idTournoi = :ID";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':ID', $id, PDO::PARAM_INT);
    if ($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $answer;
}

function changementDroitCapitaine($idJoueur, $idEquipe)
{
  static $ps = null;
  $sql = "UPDATE players SET idDroit = " . DROIT_CAPITAINE . ", idEquipe = :ID WHERE idPlayer = :IDJOUEUR";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':IDJOUEUR', $idJoueur, PDO::PARAM_INT);
    $ps->bindParam(':ID', $idEquipe, PDO::PARAM_INT);
    $answer = $ps->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $answer;
}
