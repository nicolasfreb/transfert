<?php
	class Unites{
		public $unitesAccess = [];
		
		function getUnites($pdo){
			$sql = "SELECT * from parapheur_unite order by parapheur_unite.nom";
			$res = $pdo->prepare($sql);
			$res->execute();
			return $res;
		}
		function listUnite($pdo){
			$list = [];
			$sql = "SELECT * from parapheur_unite order by parapheur_unite.nom";
			$res = $pdo->prepare($sql);
			$res->execute();
			while($row = $res->fetch()) {
				$list[$row['id']]['nom'] = $row['nom'];
			}
			return $list;
		}
	}
?>	