<?php
	if(isset($_POST['actionInterne'])){
		if($_POST['actionInterne'] == 'modifMcc'){
			$mcc = new Mcc;
			$mcc->modifMcc($connexion, $_POST['mccId'], $_POST['mccTitle'], $_POST['mccEtat'], $_POST['groupeAcces']);
		}
		if($_POST['actionInterne'] == 'supMcc' and isset($_POST['mccId'])){
			$mcc = new Mcc;
			$mcc->deleteMcc($connexion, $_POST['mccId']);
		}		
		header('Location:?action='.$_GET['action']);
	}
?>