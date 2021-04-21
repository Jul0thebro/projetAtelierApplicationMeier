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

//Permet de récupérer l'id de la dernière équipe crée 
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

//Permet de récupérer l'id du capitaine de l'équipe qui va nous permettre de savoir quelle affichage faire
function recupIdTeamCaptain($idJoueur)
{
  static $ps = null;
  $sql = "SELECT idDroit, idEquipe FROM players WHERE idPlayer = :ID";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':ID', $idJoueur, PDO::PARAM_INT);
    if ($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $answer;
}

//Permet de récuperer l'id du joueur
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

//Permet de récupérer des information qui nous serons utile pour faire un affichage sur la page principale avec les tournois
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

//Permet de changer les droits de joueur à capitaine, elle viendra s'effectuer au moment de la création d'une équipe par un joueur
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

//Permet de vérifier si un joueur à déjà une équipe et ducoup de l'empêcher d'en créer une autre
function verifSiDejaIdTeam($idJoueur)
{
  static $ps = null;
  $sql = "SELECT idEquipe FROM players WHERE idPlayer = :ID";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':ID', $idJoueur, PDO::PARAM_INT);
    if ($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $answer;
}

//Permet de vérifier si un tournoi à déjà générer un bracket
function verifSiBracketGenerer($idTournoi)
{
  static $ps = null;
  $sql = "SELECT equipe1, equipe2 FROM brackets WHERE idTournoi = :ID";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':ID', $idTournoi, PDO::PARAM_INT);
    if ($ps->execute())
      $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $answer;
}
