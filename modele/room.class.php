<?php
	class Room{
		
		public $roomId='';
		public $roomTitle='';
		public $salonId='';
		public $salonTitle='';
		public $accessRoom = [];
		
		function chargeRoom($pdo, $idRoom){
			$sql = "SELECT * from Rooms LEFT JOIN salons ON rooms.salonId = salons.salonId Where roomId = ".$idRoom." order by roomId";
			$res = $pdo->prepare($sql);
			$res->execute();			
			while($row = $res->fetch()) {
				$this->roomId = $row['roomId'];
				$this->roomTitle = $row['roomTitle'];
				$this->salonId = $row['salonId'];
				$this->salonTitle = $row['salonTitle'];
			}
		}
		function getMessage($pdo, $roomId){			
			$messages = [];
			
			$sql = "Select * FROM rooms_messages LEFT JOIN users ON creationUserId = userId WHERE roomId = ". $roomId." ORDER BY creationDate";
			
			$res = $pdo->prepare($sql);
			$res->execute();			
			while($row = $res->fetch()) {
				$messages[$row['messageId']]['messageId'] = $row['messageId'];
				$messages[$row['messageId']]['message'] = $row['message'];
				$messages[$row['messageId']]['userLogin'] = $row['userLogin'];
				$messages[$row['messageId']]['creationDate'] = $row['creationDate'];
			}
			return $messages;
		}
		function modifRoom($pdo, $roomId, $roomTitle, $salonId, $roomAcces){
			$sql ="UPDATE `rooms` SET `roomTitle` = '".$roomTitle."', `salonId` = '".$salonId."' WHERE `rooms`.`roomId` = ".$roomId;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$sql =" DELETE FROM `groupes_rooms_acces` WHERE `roomId` = ".$roomId;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$a = 0;
			$sql ="INSERT INTO `groupes_rooms_acces` (`id`,`roomId`, `groupeId`, `acces`) VALUES";
			foreach( $roomAcces as $key => $value){
				if($value != 0){
					if($a!=0) $sql .= ' , ';
					$sql .= "(NULL, '".$roomId."', '".$key."', '".$value."')";
					$a++;
				}
			}
			$res = $pdo->prepare($sql);
			$res->execute();
		}
		function deleteRoom($pdo, $roomId){
			$sql =" DELETE FROM `rooms` WHERE `rooms`.`roomId` = ".$roomId;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$sql =" DELETE FROM `rooms_messages` WHERE `roomId` = ".$roomId;
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$sql =" DELETE FROM `groupes_rooms_acces` WHERE `roomId` = ".$roomId;
			$res = $pdo->prepare($sql);
			$res->execute();
		}
		function createRoom($pdo, $roomTitle, $salonId, $roomAcces){
			$sql ="INSERT INTO `rooms` (`roomId`, `roomTitle`, `salonId`) VALUES (NULL, '".$roomTitle."', '".$salonId."')";
			$res = $pdo->prepare($sql);
			$res->execute();
			
			$a = 0;
			$sql ="INSERT INTO `groupes_rooms_acces` (`id`,`roomId`, `groupeId`, `acces`) VALUES";
			foreach( $roomAcces as $key => $value){
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
			$sql = "SELECT * from groupes_rooms_acces LEFT JOIN groupes ON groupes_rooms_acces.groupeId = groupes.groupeId WHERE groupes_rooms_acces.roomId = ".$this->roomId; 
			$res = $pdo->prepare($sql);
			$res->execute();
			while($row = $res->fetch()) {
				$this->accessRoom[$row['groupeId']] = $row['acces'];
			}
		}
	}
?>	