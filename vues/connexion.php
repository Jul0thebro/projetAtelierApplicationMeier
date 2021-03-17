<?php
session_start();
$emailUser = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$pwdUser = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING);
$error = false;

if (verifyPlayers($emailUser, $pwdUser)) {
    $pseudo = takePseudoPlayers($emailUser);
    $_SESSION["pseudo"] = $pseudo;
    header("Location: ?uc=accueil");
} else {
    $error = true;
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
    <title>Signin</title>

    <!--A mettre partout !!! -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Favicons -->



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
    <link href="css/connex.css" rel="stylesheet">
</head>

<body class="text-center">
    <form class="form-signin" method="POST" action="?uc=connexion">
        <img class="mb-4" src="img/iron-tournament-logo.png" alt="" width="150" height="150">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" value="<?php echo $emailUser; ?>" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" name="pwd" placeholder="Password" required>
        <?php 
        if ($error){
            echo "<div class=\"alert alert-danger\" role=\"alert\">
                L'email ou le mot de passe est faux !
                </div>";
        }?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <a href="?uc=enregistrement">No account ? Create one !</a>
        <br />
        <a href="?uc=accueil">Comeback to homepage</a>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
    </form>

</body>

</html>