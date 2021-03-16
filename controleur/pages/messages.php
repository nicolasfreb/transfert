<?php
	if(isset($_POST['actionInterne'])){
		if($_POST['actionInterne'] == 'depMessage' and isset($_POST['messageId'])){
			$messages = new Messages;
			$messages->depublierMessages($connexion, $_POST['messageId']);
		}
		if($_POST['actionInterne'] == 'publMessage' and isset($_POST['messageId'])){
			$messages = new Messages;
			$messages->publierMessages($connexion, $_POST['messageId']);
		}
		header('Location:?action='.$_GET['action']);
	}
?>