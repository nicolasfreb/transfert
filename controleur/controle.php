<?php
	$url = null;
	$errorNav = null;
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	
	//si l'on demande la deconnexion
	if(isset($_POST['action']) and $_POST['action'] == 'deconnexion'){
		//session_destroy();
		unset($_SESSION['user']);
		header('Location:index.php');
	}
	//si l'on demande la connexion
	else if(isset($_POST['action']) and $_POST['action'] == "connexion"){
		if (empty($_POST["login"]) or empty($_POST['password'])) {
			echo "veuillez saisir un login et un mot de passe";
		}
		else {			
			$pdo = new ConnexionBdd;
			$user = new User;
			
			$connexion = $pdo->connect($conf);			
			$return = $user->chargementUserAD("ldap://cdaoa.air", $_POST["login"], $_POST["password"], $connexion);
			if($return == 'ok'){
				header('Location:index.php');
			}
			else $erreur_log = $return;
		}			
	}
	//Affichage de la page
	else if(isset($_GET['action'])){
		$filenameVue = "vue/".$_GET['action'].".php";
		$filenameControleur = "controleur/pages/".$_GET['action'].".php";
		if (file_exists($filenameVue)){
			if(file_exists($filenameControleur)) include ($filenameControleur);
			$url = $filenameVue;
		}
		else $errorNav = '404';
	}

	$navigation = new Navigation;
	$navigation->genereUrl($errorNav, $connexion);
	$page = $navigation->getUrl();
?>