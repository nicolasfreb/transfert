<?php
	class Messages{	
		
		function getMessages($pdo){
			$sql = "SELECT * from rooms_messages LEFT JOIN users ON users.userId = rooms_messages.creationUserId LEFT JOIN rooms ON rooms.roomId = rooms_messages.roomId order by rooms_messages.messageId";
			$res = $pdo->prepare($sql);
			$res->execute();			
			return $res;
		}
		function depublierMessages($pdo, $messageId){
			$sql = "UPDATE rooms_messages SET etatMessage = '1' WHERE rooms_messages.messageId = ".$messageId;
			$res = $pdo->prepare($sql);
			$res->execute();	
		}
		function publierMessages($pdo, $messageId){
			$sql = "UPDATE rooms_messages SET etatMessage = '0' WHERE rooms_messages.messageId = ".$messageId;
			$res = $pdo->prepare($sql);
			$res->execute();	
		}
	}
?>	