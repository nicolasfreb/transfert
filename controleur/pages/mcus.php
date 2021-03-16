<?php
	if(isset($_POST['actionInterne'])){
		if($_POST['actionInterne'] == 'addMcu' and isset($_POST['mcuTitle'])){
			$mcu = new Mcu;
			$mcu->createMcu($connexion, $_POST['mcuTitle'], $_POST['mcuEtat'], $_POST['groupeAcces']);
		}
		if($_POST['actionInterne'] == 'modifMcu'){
			$mcu = new Mcu;
			$mcu->modifMcu($connexion, $_POST['mcuId'], $_POST['mcuTitle'], $_POST['mcuEtat'], $_POST['groupeAcces']);
		}
		if($_POST['actionInterne'] == 'supMcu' and isset($_POST['mcuId'])){
			$mcu = new Mcu;
			$mcu->deleteMcu($connexion, $_POST['mcuId']);
		}		
		header('Location:?action='.$_GET['action']);
	}
?>