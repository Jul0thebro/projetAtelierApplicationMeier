<?php session_start();
$_SESSION["user"] = "";
$pseudoUser = "";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Iron Tournaments</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="CSS/bootstrap.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"><img height="100" width="100" src="img/iron-tournament-logo.png" /></a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <?php
                $pseudoUser = $_SESSION["pseudo"]["pseudo"];
                if ($_SESSION["pseudo"]["pseudo"] == null) {
                    echo "<span class=\"bg-warning rounded-pill p-2\">  Vous n'êtes pas connecté !  </span>";
                } else {
                    echo "<span class=\"bg-light rounded-pill p-2\"> Vous êtes connecté en tant que " . $pseudoUser . " ! </span>";
                }
                ?>
            </li>

            <li class="nav-item text-nowrap">
                <?php
                if ($_SESSION["pseudo"]["pseudo"] == null) {
                    echo "<a class=\"nav-link\" href=\"?uc=connexion\">Se connecter</a>";
                } else {
                    echo "<br><button type=\"button\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                            Se déconnecter
                          </button> 
                          <button type=\"button\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#modalModif\">
                            Profil
                          </button>";
                }

                ?>
            </li>
        </ul>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Déconnexion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Voulez-vous vraiment vous déconnecter ?
                </div>
                <div class="modal-footer">
                    <a href="?uc=accueil" data-bs-dismiss="modal" class="btn btn-primary" role="button" data-bs-toggle="button">Annuler</a>
                    <a href="?uc=Deconnexion" class="btn btn-primary">Confirmer</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal modification de profil-->
    <div class="modal fade" id="modalModif" tabindex="-1" aria-labelledby="modalLabelModif" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelModif">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="btn btn-primary mb-1" href="?uc=accueil">
                                <span data-feather="home"></span> Accueil <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary mb-1" href="?uc=equipes">
                                Voir les équipes
                            </a>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($_SESSION["pseudo"]["pseudo"] != null) {
                                $idPlayer = recupIdPlayer($_SESSION["pseudo"]["pseudo"]);
                                $idTeam = verifSiDejaIdTeam($idPlayer["idPlayer"]);
                                if ($idTeam["idEquipe"] == null) {
                                    echo "<a class=\"btn btn-primary mb-1\" href=\"?uc=CreerEquipe\">
                                Créer une équipe
                                </a>";
                                } else {
                                }
                            } else {
                                echo "<a class=\"btn btn-primary mb-1\" href=\"\">
                                Créer une équipe
                                </a>";
                            }
                            ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if ($_SESSION["pseudo"]["pseudo"] != null) {
                                $idPlayer = recupIdPlayer($_SESSION["pseudo"]["pseudo"]);
                                $idTeam = verifSiDejaIdTeam($idPlayer["idPlayer"]);
                                if ($idTeam["idEquipe"] != null) {
                                    echo "<a class=\"btn btn-primary mb-1\" href=\"?uc=equipe&&id=" . $idTeam["idEquipe"] . "\">
                                    Mon équipe
                                    </a>";
                                } else {
                                }
                            } else {
                                echo "<a class=\"btn btn-primary mb-1\" href=\"\">
                                Mon équipe
                                </a>";
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </nav>


            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Informations</h1>
                </div>