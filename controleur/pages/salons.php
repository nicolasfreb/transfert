<?php
	if(isset($_POST['actionInterne'])){
		if($_POST['actionInterne'] == 'addSalon' and isset($_POST['salonTitle'])){
			$salon = new Salon;
			$salon->createSalon($connexion, $_POST['salonTitle'], $_POST['groupeAcces']);
		}
		if($_POST['actionInterne'] == 'modifSalon'){
			// $pdo = new ConnexionBdd;
			// $connexion = $pdo->connect($conf);
			$salon = new Salon;
			$salon->modifSalon($connexion, $_POST['salonId'], $_POST['salonTitle'], $_POST['groupeAcces']);			
		}
		if($_POST['actionInterne'] == 'supSalon' and isset($_POST['salonId'])){
			$salon = new Salon;
			$salon->deleteSalon($connexion, $_POST['salonId']);
		}		
		header('Location:?action='.$_GET['action']);
	}
?>