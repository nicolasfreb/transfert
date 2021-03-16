<?php
	class Service{
		
		public $id='';
		public $nom='';
		public $uniteId='';
		public $posX='';
		public $posY='';
		public $access = [];
		
		function chargeService($pdo, $id){
			$sql = "SELECT * from parapheur_service Where id = ".$id;
			$res = $pdo->prepare($sql);
			$res->execute();			
			while($row = $res->fetch()) {
				$this->id = $row['id'];
				$this->nom = $row['nom'];
				$this->uniteid = $row['unite_id'];
				$this->posX = $row['posx'];
				$this->posY = $row['posy'];
			}
		}
		
		function modifService($pdo, $id, $nom, $uniteid,$posX, $posY, $acces){
			$sql ="UPDATE parapheur_service SET `nom` = '".$nom."', `unite_id` = '".$uniteid."', `posx` = '".$posX."', `posy` = '".$posY."' WHERE id = ".$id;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$sql =" DELETE FROM `parapheur_acces` WHERE `parapheur_service_id` = ".$id;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$a = 0;
			$sql ="INSERT INTO `parapheur_acces` (`id`,`parapheur_service_id`, `groupe_id`, `acces`) VALUES";
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
		function modifmap($pdo, $id, $posX, $posY){
			$sql ="UPDATE parapheur_service SET `posx` = '".$posX."', `posy` = '".$posY."' WHERE id = ".$id;
			$res = $pdo->prepare($sql);
			$res->execute();
		}
		
		function deleteService($pdo, $id){
			$sql =" DELETE FROM parapheur_service WHERE id = ".$id;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$sql =" DELETE FROM parapheur_acces WHERE `parapheur_service_id` = ".$id;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$sql =" DELETE FROM `parapheur_fiche` WHERE `service_id` = ".$id;
			$res = $pdo->prepare($sql);
			$res->execute();
		}
		
		function createService($pdo, $nom, $uniteid,$posx,$posy, $serviceAcces){
			$sql ="INSERT INTO `parapheur_service` (`id`, `nom`, `unite_id`, `posx`, `posy`) VALUES (NULL, '".$nom."', '".$uniteid."', '".$posx."', '".$posy."')";
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$a = 0;
			$sql ="INSERT INTO `parapheur_acces` (`id`,`parapheur_service_id`, `groupe_id`, `acces`) VALUES";
			foreach( $serviceAcces as $key => $value){
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
			$sql = "SELECT * from parapheur_acces LEFT JOIN groupes ON parapheur_acces.groupe_id = groupes.groupeId WHERE parapheur_acces.parapheur_service_id = ".$this->id; 
			$res = $pdo->prepare($sql);
			$res->execute();
			while($row = $res->fetch()) {
				$this->access[$row['groupeId']] = $row['acces'];
			}
		}
	}
?>	