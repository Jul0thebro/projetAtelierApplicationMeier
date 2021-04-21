<?php 
$idJoueur = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
SupprMembreEquipe($idJoueur);
$idPlayer = recupIdPlayer($_SESSION["pseudo"]["pseudo"]);
$idTeam = verifSiDejaIdTeam($idPlayer["idPlayer"]);
header("Location: ?uc=equipe&&id=".$idTeam["idEquipe"]."");



