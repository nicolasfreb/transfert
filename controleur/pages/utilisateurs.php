<?php
	if(isset($_POST['actionInterne'])){
		if($_POST['actionInterne'] == 'addUser' and isset($_POST['userLogin']) and isset($_POST['userActif']) and isset($_POST['userGroupe'])){
			$user = new user;
			$user->createUser($connexion, $_POST['userLogin'], $_POST['userGroupe'], $_POST['userActif']);
		}
		if($_POST['actionInterne'] == 'modifUser' and isset($_POST['userLogin']) and isset($_POST['userActif']) and isset($_POST['userGroupe'])and isset($_POST['userId'])){
			$user = new user;
			$user->modifUser($connexion, $_POST['userId'], $_POST['userLogin'], $_POST['userGroupe'], $_POST['userActif']);			
		}
		if($_POST['actionInterne'] == 'supUser' and isset($_POST['userId'])){
			$user = new user;
			$user->deleteUser($connexion, $_POST['userId']);
		}	
		header('Location:?action='.$_GET['action']);
	}
?>