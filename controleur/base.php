<?php
	session_start();
	//On inclut le fichier de configuration
	include('../config.php');
	
	//On charge tout le dossier modèle
	$modeleDirectory = 'modele/';
	if(is_dir($modeleDirectory)){
		$dossier = opendir($modeleDirectory);
		while($fichier = readdir($dossier)){
			if(is_file($modeleDirectory.$fichier) && $fichier != '/' && $fichier != '.' && $fichier != '..'){
				include($modeleDirectory.$fichier);
			}
		}
	}
	
	//On inclut le fichier de controle général
	include("controleur/controle.php");
?>