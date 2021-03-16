<?php
	class Mcc{		
		public $mccId='';
		public $mccTitle='';
		public $etat='';
		
		function chargeMcc($pdo, $idMcc){
			$sql = "SELECT * from calendrier_evenement where id_evenement = '".$idMcc."'";
			$res = $pdo->prepare($sql);
			$res->execute();			
			while($row = $res->fetch()) {
				$this->mccId = $row['id_evenement'];
				$this->mccTitle = $row['titre_evenement'];
				$this->etat = $row['etat_evenement'];
			}
		}
		
		function modifMcc($pdo, $id, $title, $etat, $acces){
			$sql ="UPDATE `calendrier_evenement` SET `titre_evenement` = '".$title."', `etat_evenement` = '".$etat."' WHERE `id_evenement` = ".$id;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$sql =" DELETE FROM `calendrier_evenement_access` WHERE `id_evenement` = ".$id;
			$res = $pdo->prepare($sql);
			$res->execute();
		}
		
		function deleteMcc($pdo, $id){
			$sql =" 
				DELETE `calendrier_evenement`, `calendrier_evenement_commentaire`
				FROM `calendrier_evenement` 
				LEFT JOIN `calendrier_evenement_commentaire` ON calendrier_evenement.id_evenement = calendrier_evenement_commentaire.id_evenement  
				WHERE calendrier_evenement.id_evenement = ".$id;
			$res = $pdo->prepare($sql);
			$res->execute();
		}
	}
?>	