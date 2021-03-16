<?php
	class Groupes{
		function chargeGroupes($pdo){
			$sql = "SELECT * from groupes WHERE groupeSystem = 0 order by groupeTitre";
			$res = $pdo->prepare($sql);
			$res->execute();			
			return $res;
		}
	}
?>	