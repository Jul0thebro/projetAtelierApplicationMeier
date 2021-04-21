<?php
session_start();
require_once 'controllers/fonctionsAffichage.php'; 
require_once 'controllers/fonctionsAjout.php';
require_once 'controllers/fonctionsModifSuppr.php'; 
require_once 'functions/function.inc.php';
require_once 'controllers/fonctionsVerifications.php';
//Permet de définir l'accueil par défaut si la redirection d'un lien est null
$uc = empty($_GET['uc']) ? "accueil" : $_GET['uc'];

//Permet de changer le contenu de la page tout en restant sur la même
switch ($uc) {
    case 'accueil':
        include "vues/header.php";
        include "vues/accueil.php";
        break;
    case 'connexion':
        include "vues/joueur/connexion.php";
        break;
    case 'enregistrement':
        include "vues/joueur/enregistrement.php";
        break;
    case 'tournoi':
        include "vues/tournoi.php";
        break;
    case 'equipes':
        include "vues/header.php";
        include "vues/equipe/equipes.php";
        break;
    case 'equipe':
        include "vues/header.php";
        include "vues/equipe/equipe.php";
        break;
    case 'CreerEquipe':
        include "vues/equipe/creerEquipe.php";
        break;
    case 'Deconnexion':
        include "vues/joueur/deconnexion.php";
        break;
    case 'functionBracket':
        include "vues/functionBrackets.php";
        break;
    case 'monEquipe':
        include "vues/equipe/monEquipe.php";
        break;
    case 'supprimerMembre':
        include "vues/joueur/supprimerMembre.php";
        break;
}
//Ajoute le code du footer
include "vues/footer.php";
