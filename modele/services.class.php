<?php
	class Services{
		public $servicesAccess = [];
		
		function getServices($pdo){
			$sql = "SELECT * from parapheur_service order by nom";
			$res = $pdo->prepare($sql);
			$res->execute();			
			return $res;
		}
		function getServicesMap($pdo, $id){
			$sql = "SELECT * from parapheur_service Where unite_id = ".$id;
			$res = $pdo->prepare($sql);
			$res->execute();			
			return $res;
		}
		function setServicesAccess($pdo){
			$sql = "SELECT * from parapheur_acces LEFT JOIN groupes ON parapheur_acces.groupe_id = groupes.groupeId order by groupeTitre";
			$res = $pdo->prepare($sql);
			$res->execute();			
			while($row = $res->fetch()) { 
				$this->servicesAccess[$row['parapheur_service_id']][$row['groupeId']]['titre'] =  $row['groupeTitre'];
				$this->servicesAccess[$row['parapheur_service_id']][$row['groupeId']]['acces'] =  $row['acces'];
			}
		}
	}
?>	