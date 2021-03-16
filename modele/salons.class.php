<?php
	class Salons{
		public $salonsAccess = [];
		
		function getSalons($pdo){
			$sql = "SELECT * from salons order by salons.salonTitle";
			$res = $pdo->prepare($sql);
			$res->execute();			
			return $res;
		}
		function setSalonsAccess($pdo){
			$sql = "SELECT * from groupes_salons_acces LEFT JOIN groupes ON groupes_salons_acces.groupeId = groupes.groupeId order by groupeTitre";
			$res = $pdo->prepare($sql);
			$res->execute();			
			while($row = $res->fetch()) { 
				$this->salonsAccess[$row['salonId']][$row['groupeId']]['titre'] =  $row['groupeTitre'];
				$this->salonsAccess[$row['salonId']][$row['groupeId']]['acces'] =  $row['acces'];
			}
		}
	}
?>	