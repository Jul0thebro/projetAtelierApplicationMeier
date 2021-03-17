<?php
require_once 'controllers/fonctionsAffichage.php';
require_once 'controllers/fonctionsAjout.php';
require_once 'controllers/fonctionsVerifications.php';
//Permet de définir l'accueil par défaut si la redirection d'un lien est null
$uc = empty($_GET['uc']) ? "accueil" : $_GET['uc'];
//Ajoute le code du header

//Permet de changer le contenu de la page 
switch ($uc) {
    case 'accueil':
        include "vues/header.php";
        include "vues/accueil.php";
        break;
    case 'connexion':
        include "vues/connexion.php";
        break;
    case 'enregistrement':
        include "vues/enregistrement.php";
        break;
    case 'tournoi':
        include "vues/tournoi.php";
        break;
    case 'equipes':
        include "vues/header.php";
        include "vues/equipes.php";
        break;
    case 'equipe':
        include "vues/header.php";
        include "vues/equipe.php";
        break;
    case 'CreerEquipe':
        include "vues/creerEquipe.php";
        break;
    case 'Deconnexion':
        include "vues/deconnexion.php";
        break;
    case 'functionBracket':
        include "vues/functionBrackets.php";
        break;
}
//Ajoute le code du footer
include "vues/footer.php";
