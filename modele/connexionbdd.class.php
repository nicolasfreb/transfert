<?php
	class ConnexionBdd{	
		function connect($conf){
			try {
				$pdo = new PDO('mysql:host='.$conf['dbhost'].';dbname='.$conf['dbname'], $conf['dblogin'], $conf['dbpassword']);
			}
			catch (Exception $e) {
				die("L'accès à la base de donnée est impossible.");
			}			
			return $pdo;
		}
	}
?>