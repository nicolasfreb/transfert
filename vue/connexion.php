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
											<h1 class="h4 text-gray-900 mb-4">Bienvenue!</h1>
										</div>
										<form class="user" method="post" action="">
											<div class="form-group">
												<input type="Login" name="login" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Entrez votre login...">
											</div>
											<div class="form-group">
												<input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
											</div>
											<input type="hidden" value="connexion" name="action">
											<button class="btn btn-primary btn-user btn-block">Login</button>
										</form>
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