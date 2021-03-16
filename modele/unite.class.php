<?php
	class Unite{
		
		public $uniteId='';
		public $uniteTitle='';
		
		function chargeUnite($pdo, $idUnite){
			$sql = "SELECT * from parapheur_unite Where id = ".$idUnite;
			$res = $pdo->prepare($sql);
			$res->execute();			
			while($row = $res->fetch()) {
				$this->uniteId = $row['id'];
				$this->uniteTitle = $row['nom'];
			}
		}
		function modifUnite($pdo, $uniteId, $uniteTitle){
			$sql ="UPDATE parapheur_unite SET nom = '".$uniteTitle."' WHERE id = ".$uniteId;
			$res = $pdo->prepare($sql);
			$res->execute();
		}
		function deleteUnite($pdo, $uniteId){
			$sql ="
			DELETE parapheur_unite, parapheur_service , parapheur_fiche, parapheur_acces FROM `parapheur_unite`
			LEFT JOIN parapheur_service ON parapheur_unite.id = parapheur_service.unite_id
			LEFT JOIN parapheur_fiche ON parapheur_service.id = parapheur_fiche.unite_id
			LEFT JOIN parapheur_acces ON parapheur_service.id = parapheur_acces.parapheur_service_id
			WHERE parapheur_unite.id = ".$uniteId;
			$res = $pdo->prepare($sql);
			$res->execute();
		}
		function createUnite($pdo, $uniteTitle){
			$sql ="INSERT INTO parapheur_unite (`id`, `nom`) VALUES (NULL, '".$uniteTitle."')";
			$res = $pdo->prepare($sql);
			$res->execute();
		}
	}
?>	