											<?php
											$erreur = '';
											if(!isset($_GET['retour'])) $_GET['retour'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'/../..';
											if(isset($_GET['erreur'])){
												switch($_GET['erreur']){
												   case '400':
												   $erreur = 'Échec de l\'analyse HTTP.';
												   break;
												   case '401':
												   $erreur = 'Le pseudo ou le mot de passe n\'est pas correct !';
												   break;
												   case '402':
												   $erreur = 'Le client doit reformuler sa demande avec les bonnes données de paiement.';
												   break;
												   case '403':
												   $erreur = "Vous n'avez pas l'autorisation d'accèder à cette page";
												   break;
												   case '404':
												   $erreur = 'La page n\'existe pas ou plus !';
												   break;
												   case '405':
												   $erreur = 'Méthode non autorisée.';
												   break;
												   case '500':
												   $erreur = 'Erreur interne au serveur ou serveur saturé.';
												   break;
												   case '501':
												   $erreur = 'Le serveur ne supporte pas le service demandé.';
												   break;
												   case '502':
												   $erreur = 'Mauvaise passerelle.';
												   break;
												   case '503':
												   $erreur = ' Service indisponible.';
												   break;
												   case '504':
												   $erreur = 'Trop de temps à la réponse.';
												   break;
												   case '505':
												   $erreur = 'Version HTTP non supportée.';
												   break;
												   default:
												   $erreur = 'Erreur !';
												}
											}
											?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Connexion</title>
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">
	</head>
	<body class="bg-gradient-primary">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-10 col-lg-12 col-md-9">
					<div class="card o-hidden border-0 shadow-lg my-5">
						<div class="card-body p-0">
							<div class="row">
								<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
								<div class="col-lg-6">
									<div class="p-5">
										<div class="text-center">
											<h1 class="h4 text-gray-900 mb-4"><?php echo $erreur; ?></h1> 
										</div>
										<?php 
											if($_GET['erreur'] != '403'){
										 ?><a type="button" class="btn btn-danger" href="<?php echo $_GET['retour']; ?>">Retour à la page d'accueil</a><p><?php } 
										 else{
											?>
											<form method="post" id="formDeconnexion" action="">
												<button class="dropdown-item" ><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Deconnexion</button>
												<input type="hidden" name="action" value="deconnexion">
											</form>
										<?php	 
										 }
										 ?>
										<img src="img/404-illustration.jpg" alt="Oh bother..." style="width:100%;height:auto;"></p>
									</div>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
		<script src="js/sb-admin-2.min.js"></script>
	</body>
</html>