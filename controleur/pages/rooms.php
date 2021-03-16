<?php
	if(isset($_POST['actionInterne'])){	
		// $pdo = new ConnexionBdd;
		// $connexion = $pdo->connect($conf);
		if($_POST['actionInterne'] == 'addRoom' and isset($_POST['roomTitle'])){
			$room = new Room;
			$room->createRoom($connexion, $_POST['roomTitle'], $_POST['salonId'], $_POST['groupeAcces']);
		}
		if($_POST['actionInterne'] == 'modifRoom'){
			$room = new Room;
			$room->modifRoom($connexion, $_POST['roomId'], $_POST['roomTitle'], $_POST['salonId'], $_POST['groupeAcces']);
		}
		if($_POST['actionInterne'] == 'supRoom' and isset($_POST['roomId'])){
			$room = new Room;
			$room->deleteRoom($connexion, $_POST['roomId']);
		}		
		header('Location:?action='.$_GET['action']);
	}
?>