<?php
session_start();
// Variables
$tableauAffichage = array();
$idTournoi = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$bracketTournoi  = filter_input(INPUT_GET, 'tournoi', FILTER_SANITIZE_STRING);

// Permet d'aller chercher les équipes dans la base de données
$arrayTeams = readTeamsTournament($idTournoi);

$players16 = array();

for ($i = 1; $i <= 16; $i++) {
	$players16 += array($i => $i);
}

for ($l = 1; $l <= 16; $l++) {
	$players16[$l] = $arrayTeams[$l - 1]["nomEquipe"];
}

for ($i = count($players16) / 2; $i > 0; $i--) {
	$random = array_rand($players16, 2);
	array_push($tableauAffichage, $players16[$random[0]], $players16[$random[1]]);
	unset($players16[$random[0]]);
	unset($players16[$random[1]]);
}

$_SESSION["players"] = $tableauAffichage;
//echo var_dump($tableauAffichage);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Jekyll v4.1.1">
	<meta charset="UTF-8">
	<title>Tournoi</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<!-- Bootstrap core CSS -->
	<link href="/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">
	<link href="css/tournoi.css" rel="stylesheet">
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
	<div class="container-fluid">
		<div class="row">
			<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
				<div class="sidebar-sticky pt-3">
					<ul class="nav flex-column">
						<li class="nav-item">
							<a class="btn btn-info mb-1" href="?uc=accueil">
								<span data-feather="home"></span> Accueil <span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="btn btn-info mb-1" href="index.php?uc=equipes">
								Voir les équipes
							</a>
						</li>
						<li class="nav-item">
							<a class="btn btn-info mb-1" href="#">
								Créer une équipe
							</a>
						</li>
						<li class="nav-item">
							<a class="btn btn-info" href="#">
								Mon équipe
							</a>
						</li>
					</ul>
				</div>
			</nav>

			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2">Brackets of the tournament</h1>
					<div class="btn-toolbar mb-2 mb-md-0">
						<div class="btn-group mr-2">
							<form method="POST">
								<a class="btn btn-primary" href="?uc=functionBracket&&id=<?php echo $idTournoi; ?>">Générer le tournoi</a>
							</form>
							<button type="button" class="btn btn-sm btn-outline-secondary">Gérer le tournoi</button>
						</div>
					</div>
				</div>

				<div class="bracket" id="bracketPrincipale">

					<!-- matchups -> matchup -> participants -> participant ou participant winner -->
					<section class="round eighthfinals">
						<?php if ($_SESSION["huitieme"] != null)
							echo $_SESSION["huitieme"];
						?>
					</section>

					<!-- Quarts de final -->
					<section class="round quarterfinals">
						<!-- Premier bracket quarter -->
						<div class="winners">
							<div class="matchups">
								<div class="matchup">
									<div class="participants">
										<div class="participant winner">
											<span> </span>
										</div>
										<div class="participant">
											<span> </span>
										</div>
									</div>
								</div>
								<div class="matchup">
									<div class="participants">
										<div class="participant winner">
											<span> </span>
										</div>
										<div class="participant">
											<span> </span>
										</div>
									</div>
								</div>
								<div class="connector">
									<div class="merger"></div>
									<div class="line"></div>
								</div>
							</div>
						</div>
						<!-- Deuxieme bracket quarter -->
						<div class="winners">
							<div class="matchups">
								<div class="matchup">
									<div class="participants">
										<div class="participant winner">
											<span> </span>
										</div>
										<div class="participant">
											<span> </span>
										</div>
									</div>
								</div>
								<div class="matchup">
									<div class="participants">
										<div class="participant winner">
											<span> </span>
										</div>
										<div class="participant">
											<span> </span>
										</div>
									</div>
								</div>
								<div class="connector">
									<div class="merger"></div>
									<div class="line"></div>
								</div>
							</div>
						</div>
					</section>

					<!-- Demis de final -->
					<section class="round semifinals">
						<div class="winners">
							<div class="matchups">
								<div class="matchup">
									<div class="participants">
										<div class="participant winner">
											<span> </span>
										</div>
										<div class="participant">
											<span> </span>
										</div>
									</div>
								</div>
								<div class="matchup">
									<div class="participants">
										<div class="participant winner">
											<span> </span>
										</div>
										<div class="participant">
											<span> </span>
										</div>
									</div>
								</div>
							</div>
							<div class="connector">
								<div class="merger"></div>
								<div class="line"></div>
							</div>
						</div>
					</section>

					<!-- final -->
					<section class="round finals">
						<div class="winners">
							<div class="matchups">
								<div class="matchup">
									<div class="participants">
										<div class="participant winne">
											<span> </span>
										</div>
										<div class="participant">
											<span> </span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>

				<script>
					/*var nannnn = document.getElementById('bracketPrincipale').innerHTML;
					JSON.stringify(nannn);*/
				</script>
		</div>
		</main>
	</div>
	</div>
</body>

</html>