<?php
	class Mccs{
		public $mccsAccess = [];
		
		function getMccs($pdo){
			$sql = "SELECT * from calendrier_evenement LEFT JOIN calendrier_main_courante ON calendrier_evenement.id_calendrier = calendrier_main_courante.id_calendrier WHERE calendrier_evenement.id_calendrier <> 0 order by titre_evenement";
			$res = $pdo->prepare($sql);
			$res->execute();			
			return $res;
		}
	}
?>	