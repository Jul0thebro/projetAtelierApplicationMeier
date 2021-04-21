<?php 

// Va permettre de supprimer un membre de l'équipe, elle destinée au capitaine de l'équipe
function SupprMembreEquipe($idJoueur)
{
  static $ps = null;
  $sql = "INSERT INTO players (idEquipe) VALUES (null) WHERE idPlayer = :ID";
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

// Va permettre de supprimer un membre de l'équipe, elle destinée au capitaine de l'équipe
function SupprPaireEquipesTournoi($idTournoi)
{
  static $ps = null;
  $sql = "DELETE FROM brackets WHERE idTournoi = :ID";
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