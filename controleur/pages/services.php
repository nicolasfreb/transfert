<?php
	if(isset($_POST['actionInterne'])){
		if($_POST['actionInterne'] == 'addService' and isset($_POST['serviceTitle'])){
			$service = new Service;
			$service->createService($connexion, $_POST['serviceTitle'],$_POST['uniteId'],$_POST['posx'],$_POST['posy'], $_POST['groupeAcces']);
		}
		if($_POST['actionInterne'] == 'modifService'){
			$service = new Service;
			$service->modifService($connexion, $_POST['id'], $_POST['serviceTitle'],$_POST['uniteId'],$_POST['posx'],$_POST['posy'], $_POST['groupeAcces']);			
		}
		if($_POST['actionInterne'] == 'supService' and isset($_POST['id'])){
			$service = new Service;
			$service->deleteService($connexion, $_POST['id']);
		}
		if($_POST['actionInterne'] == 'modifmap'){
			$service = new Service;
			$service->modifmap($connexion, $_POST['id'], $_POST['posx'], $_POST['posy']);
		}
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')  $url = "https"; 
		else $url = "http"; 
			
		// Ajoutez // à l'URL.
		$url .= "://"; 

		// Ajoutez l'hôte (nom de domaine, ip) à l'URL.
		$url .= $_SERVER['HTTP_HOST']; 

		// Ajouter l'emplacement de la ressource demandée à l'URL
		$url .= $_SERVER['REQUEST_URI']; 
		header($url);
	}
?>