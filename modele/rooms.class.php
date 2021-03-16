<?php
	class Rooms{
		public $RoomsAccess = [];
		
		function getRooms($pdo){
			$sql = "SELECT * from Rooms LEFT JOIN salons ON rooms.salonId = salons.salonId order by rooms.roomId";
			$res = $pdo->prepare($sql);
			$res->execute();			
			return $res;
		}
		function setRoomsAccess($pdo){
			$sql = "SELECT * from groupes_rooms_acces LEFT JOIN groupes ON groupes_rooms_acces.groupeId = groupes.groupeId order by groupeTitre";
			$res = $pdo->prepare($sql);
			$res->execute();			
			while($row = $res->fetch()) { 
				$this->RoomsAccess[$row['roomId']][$row['groupeId']]['titre'] =  $row['groupeTitre'];
				$this->RoomsAccess[$row['roomId']][$row['groupeId']]['acces'] =  $row['acces'];
			}
		}
	}
?>	