<?php
//Constantes 
const DROIT_DE_BASE = 3;
const NB_JOUEURS = 5;

//Méthodes

//Permet d'ajouter un joueur
function addPlayers($email, $pwd, $pseudo, $age, $jeu)
{
  static $ps = null;
  $sql = "INSERT INTO players (email, passwords, pseudo, age, idDroit, idJeu) VALUES (:EMAIL, :PWD, :PSEUDO, :AGE, " . DROIT_DE_BASE . ", :JEU)";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':EMAIL', $email, PDO::PARAM_STR);
    $ps->bindParam(':PSEUDO', $pseudo, PDO::PARAM_STR);
    $ps->bindParam(':PWD', $pwd, PDO::PARAM_STR);
    $ps->bindParam(':AGE', $age, PDO::PARAM_INT);
    $ps->bindParam(':JEU', $jeu, PDO::PARAM_INT);
    $answer = $ps->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}

//Permet de créer une équipe 
function addTeam($nomEquipe, $jeu)
{
  static $ps = null;
  $sql = "INSERT INTO equipes (nomEquipe, idJeu, nbJoueurs) VALUES (:NOM, :JEU, " . NB_JOUEURS . ")";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':NOM', $nomEquipe, PDO::PARAM_STR);
    $ps->bindParam(':JEU', $jeu, PDO::PARAM_INT);
    $answer = $ps->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}


// Permet de sauvegarder le bracket après avoir généré le tournoi
function saveBracket($equipe1, $equipe2, $idTournoi)
{
  static $ps = null;
  $sql = "INSERT INTO brackets (equipe1, equipe2, idTournoi) VALUES (:EQUIPE1, :EQUIPE2, :TOURNOI);";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':TOURNOI', $idTournoi, PDO::PARAM_INT);
    $ps->bindParam(':EQUIPE1', $equipe1, PDO::PARAM_STR);
    $ps->bindParam(':EQUIPE2', $equipe2, PDO::PARAM_STR);
    $answer = $ps->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $answer;
}

//Permet de vérifier à la connexion si les infos données sont déjà dans la base de données
function verifyPlayers($email, $pwd)
{
  static $ps = null;
  $sql = "SELECT * FROM players WHERE email = :EMAIL AND passwords = :PWD";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':EMAIL', $email, PDO::PARAM_STR);
    $ps->bindParam(':PWD', $pwd, PDO::PARAM_STR);
    if ($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}

//Permet de récupéper le pseudo d'un joueur par rapport à son email, cela va permettre de faire un affichage 
function takePseudoPlayers($email)
{
  static $ps = null;
  $sql = "SELECT pseudo FROM players WHERE email = :EMAIL";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':EMAIL', $email, PDO::PARAM_STR);
    if ($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}
