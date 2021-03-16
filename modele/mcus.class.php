<?php
	class Mcus{
		public $mcusAccess = [];
		
		function getMcus($pdo){
			$sql = "SELECT * from calendrier_evenement WHERE id_calendrier = 0 order by titre_evenement";
			$res = $pdo->prepare($sql);
			$res->execute();			
			return $res;
		}
		function setMcusAccess($pdo){
			$sql = "SELECT * from calendrier_evenement_access LEFT JOIN groupes ON calendrier_evenement_access.groupe_id = groupes.groupeId order by groupeTitre";
			$res = $pdo->prepare($sql);
			$res->execute();			
			while($row = $res->fetch()) { 
				$this->mcusAccess[$row['evenement_id']][$row['groupe_id']]['titre'] =  $row['groupeTitre'];
				$this->mcusAccess[$row['evenement_id']][$row['groupe_id']]['acces'] =  $row['acces_niveau'];
			}
		}
	}
?>	