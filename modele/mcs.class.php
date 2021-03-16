<?php
	class Mcs{
		public $mcsAccess = [];
		
		function getMcs($pdo){
			$sql = "SELECT * from calendrier_main_courante order by nom";
			$res = $pdo->prepare($sql);
			$res->execute();			
			return $res;
		}
		function setMcsAccess($pdo){
			$sql = "SELECT * from calendrier_groupes_access LEFT JOIN groupes ON calendrier_groupes_access.groupe_id = groupes.groupeId order by groupeTitre";
			$res = $pdo->prepare($sql);
			$res->execute();			
			while($row = $res->fetch()) { 
				$this->mcsAccess[$row['calendrier_id']][$row['groupe_id']]['titre'] =  $row['groupeTitre'];
				$this->mcsAccess[$row['calendrier_id']][$row['groupe_id']]['acces'] =  $row['acces_niveau'];
			}
		}
	}
?>	