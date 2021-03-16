<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<title>Administration IKM CDAOA</title>
		
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="css/sb-admin-2.css" rel="stylesheet">
		<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">	
		<link rel="stylesheet" href="css/jquery-ui.css">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
	</head>
	<body id="page-top">
		<?php 
			if($url != null)  include($url);
			else include('vue/accueil.php');
		?>
		<div id="wrapper">
			<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
				<a class="sidebar-brand d-flex align-items-center justify-content-center" href="mailto:cdaoa-cem-bpp.resp.fct@intradef.gouv.fr">
					<div class="sidebar-brand-icon rotate-n-15">
						<img style="width:50px;height:auto;" src="img/patch.png">
					</div>
					<div class="sidebar-brand-text mx-3">IKM CDAOA</div>
				</a>
				<hr class="sidebar-divider my-0">
				<li class="nav-item active">
					<a class="nav-link" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>">
						<i class="fas fa-fw fa-home"></i>
						<span>Accueil</span>
					</a>
				</li>
				<hr class="sidebar-divider">
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						<i class="fas fa-fw fa-comments "></i><span>Chat</span>
					</a>
					<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<a class="collapse-item" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>?action=salons">Salons</a>
							<a class="collapse-item" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>?action=rooms">Rooms</a>
							<a class="collapse-item" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>?action=messages">Messages</a>
						</div>
					</div>
				</li>	
				
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTree" aria-expanded="true" aria-controls="collapseTree">
						<i class="fa fa-calendar"></i><span>Main Courante</span>
					</a>
					<div id="collapseTree" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<a class="collapse-item" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>?action=mcs">Calendrier Journalière</a>
							<a class="collapse-item" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>?action=mccs">Journalière</a>
							<a class="collapse-item" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>?action=mcus">Unique</a>
						</div>
					</div>
				</li>
				
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
						<i class="fas fa-fw fa-comments "></i><span>E-parapheur</span>
					</a>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<a class="collapse-item" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>?action=unites">Unités</a>
							<a class="collapse-item" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>?action=services">Services</a>
						</div>
					</div>
				</li>
				
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsefoor" aria-expanded="true" aria-controls="collapsefoor">
						<i class="fa fa-plane"></i><span>Carte des moyens</span>
					</a>
					<div id="collapsefoor" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<a class="collapse-item" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>?action=carteType">Type</a>
							<a class="collapse-item" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>?action=carteMoyens">Moyens</a>
						</div>
					</div>
				</li>
				
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsefive" aria-expanded="true" aria-controls="collapsefive">
						<i class="fas fa-fw fa-user-circle"></i><span>Utilisateurs</span>
					</a>
					<div id="collapsefive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<a class="collapse-item" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>?action=utilisateurs">Utilisateurs</a>
							<a class="collapse-item" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>?action=groupes">Groupes</a>
						</div>
					</div>
				</li>
				
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
						<i class="fas fa-fw fa-cog"></i><span>Système</span>
					</a>
					<div id="collapseSix" class="collapse" aria-labelledby="headingTree" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<a class="collapse-item" href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>?action=parametres">parametres</a>
						</div>
					</div>
				</li>
				
				<hr class="sidebar-divider d-none d-md-block">
				<div class="text-center d-none d-md-inline">
					<button class="rounded-circle border-0" id="sidebarToggle"></button>
				</div>
			</ul>
			<div id="content-wrapper" class="d-flex flex-column">
				<div id="content">
					<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
						<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
							<i class="fa fa-bars"></i>
						</button>
						<div class="sidebar-brand-text mx-3"><h4>Administration de l'IKM CDAOA</h4></div>
						<ul class="navbar-nav ml-auto">								
							<li class="nav-item dropdown no-arrow">
								<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['user']['userNom'].' '.$_SESSION['user']['userPrenom'];   ?></span>
									<img class="img-profile rounded-circle" src="img/uservue.png">
								</a>
								<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
									<form method="post" id="formDeconnexion" action="">
										<button class="dropdown-item" ><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Deconnexion</button>
										<input type="hidden" name="action" value="deconnexion">
									</form>
									</a>
								</div>
							</li>
						</ul>
					</nav>	
					<div class="container-fluid">
						<?php if(isset($titre)){ ?>
							<div class="d-sm-flex align-items-center justify-content-between mb-4">
								<h1 class="h3 mb-0 text-gray-800"><?php echo $titre; ?></h1>
							</div>
						<?php } ?>
						<?php if(isset($button)){ ?>
							<div class="row">
								<div class="col-xl-3 col-md-6 mb-4">
									<div class="card border-left-primary shadow h-100 py-2">
										<div class="card-body">
											<div class="row no-gutters align-items-center">
												<div class="col mr-2">
													<?php echo $button; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>										
						<?php } ?>						
						<?php if(isset($contenu)){ ?>
							<div class="col-xl-12 col-lg-12">
								<div class="card shadow mb-4">
									<div class="card-body">									
										<?php if(isset($contenu)) echo $contenu; ?>
									</div>
								</div>
							</div>								
						<?php } ?>		
					</div>
				</div>
				<footer class="sticky-footer bg-white">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>Copyright Frébault Nicolas</span>
						</div>
					</div>
				</footer>
			</div>
		</div>
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
		</a>
		
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>		
		<script src="vendor/jquery-easing/jquery.easing.min.js"></script>		
		<script src="js/sb-admin-2.min.js"></script>		
		<script src="vendor/chart.js/Chart.js"></script> 		
		<script src="vendor/datatables/jquery.dataTables.min.js"></script>
		<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>		
		<script src="js/demo/datatables-demo.js"></script>			
		<script src="js/socket.io/socket.io.js"></script>
		<script src="js/script.js"></script>
	</body>
</html>