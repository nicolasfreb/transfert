<?php
	if(isset($_POST['actionInterne'])){
		if($_POST['actionInterne'] == 'addUnite' and isset($_POST['nom'])){
			$unite = new Unite;
			$unite->createUnite($connexion, $_POST['nom']);
		}
		if($_POST['actionInterne'] == 'modifUnite'){
			$unite = new Unite;
			$unite->modifUnite($connexion, $_POST['id'], $_POST['nom']);			
		}
		if($_POST['actionInterne'] == 'supUnite' and isset($_POST['id'])){
			$unite = new Unite;
			$unite->deleteUnite($connexion, $_POST['id']);
		}		
		header('Location:?action='.$_GET['action']);
	}
?>