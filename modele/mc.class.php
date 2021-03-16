<?php
	class Mc{		
		public $mcId='';
		public $mcTitle='';
		public $etat='';
		public $accessMc = [];
		
		function chargeMc($pdo, $idMc){
			$sql = "SELECT * from calendrier_main_courante where id_calendrier = '".$idMc."'";
			$res = $pdo->prepare($sql);
			$res->execute();			
			while($row = $res->fetch()) {
				$this->mcId = $row['id_calendrier'];
				$this->mcTitle = $row['nom'];
				$this->etat = $row['verrouillageEventDate'];
			}
		}
		
		function modifMc($pdo, $mcId, $mcTitle, $etat, $Acces){
			$sql ="UPDATE `calendrier_main_courante` SET `nom` = '".$mcTitle."', `verrouillageEventDate` = '".$etat."' WHERE `id_calendrier` = ".$mcId;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$sql =" DELETE FROM `calendrier_groupes_access` WHERE `calendrier_id` = ".$mcId;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$a = 0;
			$sql ="INSERT INTO `calendrier_groupes_access` (`id`,`calendrier_id`, `groupe_id`, `acces_niveau`) VALUES";
			foreach( $Acces as $key => $value){
				if($value != 0){
					if($a!=0) $sql .= ' , ';
					$sql .= "(NULL, '".$mcId."', '".$key."', '".$value."')";
					$a++;
				}
			}
			$res = $pdo->prepare($sql);
			$res->execute();
		}
		function deleteMc($pdo, $mcId){
			$sql =" 
				DELETE `calendrier_main_courante`,`calendrier_groupes_access`,  `calendrier_evenement`, `calendrier_evenement_commentaire` , `calendrier_evenement_access`
				FROM `calendrier_main_courante` 
				LEFT JOIN `calendrier_groupes_access` ON calendrier_main_courante.id_calendrier = calendrier_groupes_access.calendrier_id  
				LEFT JOIN `calendrier_evenement` ON calendrier_groupes_access.calendrier_id = calendrier_evenement.id_calendrier  
				LEFT JOIN `calendrier_evenement_commentaire` ON calendrier_evenement.id_evenement = calendrier_evenement_commentaire.id_evenement  
				LEFT JOIN `calendrier_evenement_access` ON calendrier_evenement.id_evenement = calendrier_evenement_access.evenement_id  
				WHERE calendrier_main_courante.id_calendrier = ".$mcId;
			$res = $pdo->prepare($sql);
			$res->execute();
		}
		function createMc($pdo, $mcTitle, $etat, $mcAcces){
			$sql ="INSERT INTO `calendrier_main_courante` (`id_calendrier`, `nom`, `verrouillageEventDate`) VALUES (NULL, '".$mcTitle."', '".$etat."')";
			$res = $pdo->prepare($sql);
			$res->execute();
			$a = 0;
			$sql ="INSERT INTO `calendrier_groupes_access` (`id`,`calendrier_id`, `groupe_id`, `acces_niveau`) VALUES";
			foreach( $mcAcces as $key => $value){
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
			$sql = "SELECT * from calendrier_groupes_access LEFT JOIN groupes ON calendrier_groupes_access.groupe_id = groupes.groupeId WHERE calendrier_groupes_access.calendrier_id = ".$this->mcId; 
			$res = $pdo->prepare($sql);
			$res->execute();
			while($row = $res->fetch()) {
				$this->accessMc[$row['groupe_id']] = $row['acces_niveau'];
			}
		}
	}
?>	