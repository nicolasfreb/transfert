<?php
	class Navigation{
		private $url;
		
		function genereUrl($error, $pdo){
			if($error == '404'){
				$_GET['erreur'] = '404';
				$_GET['retour'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
				$this->url = "erreur/erreur.php";
			}
			else if(!isset($_SESSION['user']['userPrenom'])){
				$this->url = "vue/connexion.php";
			}
			else{
				$user = new User;
				$secur = $user->verifAccesAdmin($pdo);
				if($secur != 0){
					if(!isset($_GET['tmpl']) || $_GET['tmpl'] != 'cache') $this->url = "vue/template.php";
					else $this->url = "vue/cache.php";
				}
				else {
					$_GET['erreur'] = '403';
					$_GET['retour'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
					$this->url = "erreur/erreur.php";
				}
			}
		}	
		
		function getUrl(){
			return $this->url;
		}	
	}	
?>