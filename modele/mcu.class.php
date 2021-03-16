<?php
	class Mcu{		
		public $mcuId='';
		public $mcuTitle='';
		public $etat='';
		public $accessMcu = [];
		
		function chargeMcu($pdo, $idMcu){
			$sql = "SELECT * from calendrier_evenement where id_evenement = '".$idMcu."'";
			$res = $pdo->prepare($sql);
			$res->execute();			
			while($row = $res->fetch()) {
				$this->mcuId = $row['id_evenement'];
				$this->mcuTitle = $row['titre_evenement'];
				$this->etat = $row['etat_evenement'];
			}
		}
		
		function modifMcu($pdo, $id, $title, $etat, $acces){
			$sql ="UPDATE `calendrier_evenement` SET `titre_evenement` = '".$title."', `etat_evenement` = '".$etat."' WHERE `id_evenement` = ".$id;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$sql =" DELETE FROM `calendrier_evenement_access` WHERE `id_evenement` = ".$id;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$a = 0;
			$sql ="INSERT INTO `calendrier_evenement_access` (`id`,`evenement_id`, `groupe_id`, `acces_niveau`) VALUES";
			foreach( $acces as $key => $value){
				if($value != 0){
					if($a!=0) $sql .= ' , ';
					$sql .= "(NULL, '".$id."', '".$key."', '".$value."')";
					$a++;
				}
			}
			$res = $pdo->prepare($sql);
			$res->execute();
		}
		function deleteMcu($pdo, $id){
			$sql =" 
				DELETE `calendrier_evenement`, `calendrier_evenement_commentaire` , `calendrier_evenement_access`
				FROM `calendrier_evenement` 
				LEFT JOIN `calendrier_evenement_commentaire` ON calendrier_evenement.id_evenement = calendrier_evenement_commentaire.id_evenement  
				LEFT JOIN `calendrier_evenement_access` ON calendrier_evenement.id_evenement = calendrier_evenement_access.evenement_id  
				WHERE calendrier_evenement.id_evenement = ".$id;
			$res = $pdo->prepare($sql);
			$res->execute();
		}
		function createMcu($pdo, $title, $etat, $acces){
			$sql ="INSERT INTO `calendrier_evenement` (`id_evenement`, `titre_evenement`,  `date_debut_evenement`,  `date_fin_evenement`,  `couleur_evenement`,  `id_calendrier`,  `etat_evenement`,  `chrono`) 
			VALUES (NULL, '".$title."', '', '', '', '0', '".$etat."', NULL)";
			$res = $pdo->prepare($sql);
			$res->execute();
			$a = 0;
			$sql ="INSERT INTO `calendrier_evenement_access` (`id`,`evenement_id`, `groupe_id`, `acces_niveau`) VALUES";
			foreach( $acces as $key => $value){
				if($value != 0){
					if($a!=0) $sql .= ' , ';
					$sql .= "(NULL, '".$pdo->lastInsertId()."', '".$key."', '".$value."')";
					$a++;
				}
			}
			$res = $pdo->prepare($sql);
			$res->execute();
		}
		function chargeAccess($pdo){
			$sql = "SELECT * from calendrier_evenement_access LEFT JOIN groupes ON calendrier_evenement_access.groupe_id = groupes.groupeId WHERE calendrier_evenement_access.evenement_id = ".$this->mcuId; 
			$res = $pdo->prepare($sql);
			$res->execute();
			while($row = $res->fetch()) {
				$this->accessMcu[$row['groupe_id']] = $row['acces_niveau'];
			}
		}
	}
?>	