<?php
session_start();
$nomEquipe = filter_input(INPUT_POST, 'nomEquipe', FILTER_SANITIZE_STRING);
$jeu = filter_input(INPUT_POST, 'jeu', FILTER_SANITIZE_STRING);
if ($nomEquipe != null && $jeu != null) {
    $idGame = takeIdGame($jeu);
    $idJoueur= recupIdPlayer($_SESSION["pseudo"]["pseudo"]);
    //Il faut récupérer l'id du joueur pour pouvoir le modifier avec l'update
    addTeam($nomEquipe, $idGame["idJeu"]);
    $idEquipe = recupIdTeam();
    changementDroitCapitaine($idJoueur["idPlayer"], $idEquipe["MAX(idEquipe)"]);
    header("Location: ?uc=accueil");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Sign up</title>

    <!--A mettre partout !!! -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
    <link href="css/connex.css" rel="stylesheet">
</head>

<body class="text-center">
    <form class="form-signin" method="POST" action="?uc=CreerEquipe">
        <img class="mb-4" src="img/iron-tournament-logo.png" alt="" width="150" height="150">
        <h1 class="h3 mb-3 font-weight-normal">Créer une équipe</h1>
        <label for="inputEmail" class="sr-only">Nom de l'équipe</label>
        <input type="text" id="inputEmail" class="form-control" name="nomEquipe" placeholder="Nom de l'équipe" required autofocus>
        <select class="form-select" id="jeu" name="jeu">
            <?php
            $lesJeux = ReadGames();
            foreach ($lesJeux as $jeu) {
                echo "<option value=\"" . $jeu["nomJeu"] . "\">" . $jeu["nomJeu"] . "</option>";
            }
            ?>
        </select>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Créer l'équipe</button>
        <a href="?uc=accueil">Comeback to homepage</a>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
    </form>

</body>

</html>