<?php
require "./modeles/functionDatabase.php";

function arrayToHtmlTable($array, $header = true)
{
  $html = "";
  if (!empty($array)) {
    /* Entete ?
    if ($header) {
      $html .= "\n    <tr>";
      foreach ($array[0] as $key => $value) {
        $html .= "\n      <th>$key</th>";
      }
      $html .= "\n    </tr>\n";
    }*/
    // Chaque ligne
    foreach ($array as $line) {
      $html .= "\n    <tr>";
      $html  .= "\n <td><a  class=\"btn btn-info\" href=\"?uc=tournoi&&id=" . $line["idTournoi"] . "\">Voir</a> </td>";
      $nb = nbPlacesRestantes($line["idTournoi"]);
      $nbPlaces = 16 - $nb["Count(idEquipe)"];
      $html  .= "\n <td><b>".$nbPlaces."/16</b></td>";
      // Contient un  tableau
      foreach ($line as $value) {
        $html .= "\n      <td>$value</td>\n";
      }
      $html .= "\n    </tr>\n";
    }
  }
  return $html;
}

function readTournament($from = 0, $offset = 2)
{
  static $ps = null;
  $sql = 'SELECT tournois.nomTournoi, jeux.nomJeu, affrontements.nomAffrontement, tournois.dateTournoi,';
  $sql .= ' tournois.nbEquipes, phases.nomPhase, tournois.idTournoi FROM tournois,';
  $sql .= ' jeux, phases, affrontements WHERE tournois.idJeu = jeux.idJeu AND';
  $sql .= ' phases.idPhase = tournois.idPhase AND tournois.idAffrontement = affrontements.idAffrontement';
  $sql .= ' ORDER BY tournois.dateTournoi ASC LIMIT :FROM,:OFFSET;';

  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':FROM', $from, PDO::PARAM_INT);
    $ps->bindParam(':OFFSET', $offset, PDO::PARAM_INT);

    if ($ps->execute())
      $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}

function readTeamsTournament($idTournoi)
{
  static $ps = null;
  $sql = 'SELECT equipes.nomEquipe FROM equipes, equipes_tournoi WHERE equipes.idEquipe = equipes_tournoi.idEquipe AND equipes_tournoi.idTournoi = :TOURNOI ;';

  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':TOURNOI', $idTournoi, PDO::PARAM_INT);

    if ($ps->execute())
      $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}

function saveBracket($contenueBracket, $idTournoi)
{
  static $ps = null;
  $sql = "INSERT INTO bracket (contenueBracket, idTournoi) VALUES (:CONTENUE, :TOURNOI);";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':TOURNOI', $idTournoi, PDO::PARAM_INT);
    $ps->bindParam(':CONTENUE', $contenueBracket, PDO::PARAM_STR);
    if ($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}

function affichageEquipes()
{
  static $ps = null;
  $sql = "SELECT nomEquipe, dateCreation, nbJoueurs, idEquipe FROM equipes;";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    if ($ps->execute())
      $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}

function arrayToHtmlTableTeams($array, $header = true)
{
  $html = "";
  if (!empty($array)) {
    /* Entete ?
    if ($header) {
      $html .= "\n    <tr>";
      foreach ($array[0] as $key => $value) {
        $html .= "\n      <th>$key</th>";
      }
      $html .= "\n    </tr>\n";
    }*/
    // Chaque ligne
    foreach ($array as $line) {
      $html .= "\n    <tr>";
      $html  .= "\n <td><a class=\"btn btn-info\" href=\"?uc=equipe&&id=" . $line["idEquipe"] . "\">Voir</a></td>";
      // Contient un  tableau
      foreach ($line as $value) {
        $html .= "\n      <td>$value</td>\n";
      }
      $html .= "\n    </tr>\n";
    }
  }
  return $html;
}


function affichageJoueurs($idEquipe)
{
  static $ps = null;
  $sql = "SELECT players.pseudo, players.age, droitsusers.nomDroit FROM players, droitsusers WHERE players.idDroit = droitsusers.idDroit AND players.idEquipe = :EQUIPE;";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':EQUIPE', $idEquipe, PDO::PARAM_INT);
    if ($ps->execute())
      $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}

function arrayToHtmlTablePlayers($array, $header = true)
{
  $html = "";
  if (!empty($array)) {
    /* Entete ?
    if ($header) {
      $html .= "\n    <tr>";
      foreach ($array[0] as $key => $value) {
        $html .= "\n      <th>$key</th>";
      }
      $html .= "\n    </tr>\n";
    }*/
    // Chaque ligne
    foreach ($array as $line) {
      $html .= "\n    <tr>";
      //$html  .= "\n <td><a href=\"?uc=equipe\">Voir</a></td>";
      // Contient un  tableau
      foreach ($line as $value) {
        $html .= "\n      <td>$value</td>\n";
      }
      $html .= "\n    </tr>\n";
    }
  }
  return $html;
}

function takeIdGame($jeu){
  static $ps = null;
  $sql = "SELECT idJeu FROM jeux WHERE nomJeu LIKE :JEU;";
  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam('JEU', $jeu, PDO::PARAM_STR);
    if ($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}

function ReadGames()
{
  static $ps = null;
  $sql = 'SELECT nomJeu FROM jeux;';

  if ($ps == null) {
    $ps = dbTournament()->prepare($sql);
  }
  $answer = false;
  try {
    if ($ps->execute())
      $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}
