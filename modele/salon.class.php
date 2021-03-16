<?php
	class Salon{
		
		public $salonId='';
		public $salonTitle='';
		public $accessSalon = [];
		
		function chargeSalon($pdo, $idSalon){
			$sql = "SELECT * from salons Where salonId = ".$idSalon." order by salonId";
			$res = $pdo->prepare($sql);
			$res->execute();			
			while($row = $res->fetch()) {
				$this->salonId = $row['salonId'];
				$this->salonTitle = $row['salonTitle'];
			}
		}
		function modifSalon($pdo, $salonId, $salonTitle, $salonAcces){
			$sql ="UPDATE `salons` SET `salonTitle` = '".$salonTitle." WHERE `salons`.`salonId` = ".$salonId;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$sql =" DELETE FROM `groupes_salons_acces` WHERE `salonId` = ".$salonId;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$a = 0;
			$sql ="INSERT INTO `groupes_salons_acces` (`id`,`salonId`, `groupeId`, `acces`) VALUES";
			foreach( $salonAcces as $key => $value){
				if($value != 0){
					if($a!=0) $sql .= ' , ';
					$sql .= "(NULL, '".$salonId."', '".$key."', '".$value."')";
					$a++;
				}
			}
			$res = $pdo->prepare($sql);
			$res->execute();
		}
		function deleteSalon($pdo, $salonId){
			$sql ="
			DELETE salons, groupes_salons_acces , rooms , rooms_messages, groupes_rooms_acces FROM `salons`
			LEFT JOIN groupes_salons_acces ON salons.salonId = groupes_salons_acces.salonId
			LEFT JOIN rooms ON salons.salonId = rooms.salonId
			LEFT JOIN groupes_rooms_acces ON rooms.roomId = groupes_rooms_acces.roomId
			LEFT JOIN rooms_messages ON rooms.roomId = rooms_messages.roomId
			WHERE `salons`.`salonId` = ".$salonId;
			$res = $pdo->prepare($sql);
			$res->execute();
		}
		function createSalon($pdo, $salonTitle, $salonAcces){
			$sql ="INSERT INTO `salons` (`salonId`, `salonTitle`) VALUES (NULL, '".$salonTitle."')";
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$a = 0;
			$sql ="INSERT INTO `groupes_salons_acces` (`id`,`salonId`, `groupeId`, `acces`) VALUES";
			foreach($salonAcces as $key => $value){
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
			$sql = "SELECT * from groupes_salons_acces LEFT JOIN groupes ON groupes_salons_acces.groupeId = groupes.groupeId WHERE groupes_salons_acces.salonId = ".$this->salonId; 
			$res = $pdo->prepare($sql);
			$res->execute();
			while($row = $res->fetch()) {
				$this->accessSalon[$row['groupeId']] = $row['acces'];
			}
		}
	}
?>	