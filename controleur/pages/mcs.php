<?php
	if(isset($_POST['actionInterne'])){
		if($_POST['actionInterne'] == 'addMc' and isset($_POST['mcTitle'])){
			$mc = new Mc;
			$mc->createMc($connexion, $_POST['mcTitle'], $_POST['mcEtat'], $_POST['groupeAcces']);
		}
		if($_POST['actionInterne'] == 'modifMc'){
			$mc = new Mc;
			$mc->modifMc($connexion, $_POST['mcId'], $_POST['mcTitle'], $_POST['mcEtat'], $_POST['groupeAcces']);
		}
		if($_POST['actionInterne'] == 'supMc' and isset($_POST['mcId'])){
			$mc = new Mc;
			$mc->deleteMc($connexion, $_POST['mcId']);
		}		
		header('Location:?action='.$_GET['action']);
	}
?>