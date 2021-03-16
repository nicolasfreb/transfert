<?php	
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$titre = 'Unités';
	$unites = new Unites;
	$uniteList = $unites->getUnites($connexion);	
	
	$button = '<a type="button" href="?action=unites&unite=0" class="btn btn-success btn-icon-split" style="margin-left:5"><span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span><span class="text">Nouvelle unité</span></a>';
	$contenu = "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
		$contenu .="<thead>";
			$contenu .="<tr>";
				$contenu .="<th scope='col'>Id</th>";
				$contenu .="<th scope='col'>Nom</th>";
				$contenu .="<th scope='col'>Map</th>";
				$contenu .="<th scope='col'>Voir</th>";
				$contenu .="<th scope='col'>Modifier</th>";
				$contenu .="<th scope='col'>Supprimer</th>";
			$contenu .="</tr>";
		$contenu .="</thead>";
		$contenu .="<tbody>";
			while($row = $uniteList->fetch()) {
				$contenu .="<tr>";
					$contenu .="<td>";
						$contenu .=$row['id'];
					$contenu .="</td>";
					$contenu .="<td>";
						$contenu .=$row['nom'];
					$contenu .="</td>";
					$contenu .="<td>";
						$contenu .='<a href="?action=services&map='.$row['id'].'"><img style="width:80px;height:auto;" src="img/carte.png"></a>';
					$contenu .="</td>";
					$contenu .='<td>';
						$contenu .='<a type="button"  target="_blank" class="btn btn-success btn-icon-split"  href="'.$conf['adresseredirect'].'/unite/'.$row['id'].'">';
							$contenu .='<span class="icon text-white-50"><i class="fas fa-share"></i></span>';
							$contenu .='<span class="text hidden">Voir l\'unité</span>';
						$contenu .='</a>';
					$contenu .='</td>';
					$contenu .='<td>';
						$contenu .='<a type="button" class="btn btn-primary btn-icon-split"  href="?action=unites&unite='.$row['id'].'">';
							$contenu .='<span class="icon text-white-50"><i class="fas fa-cog"></i></span>';
							$contenu .='<span class="text hidden">Modifier</span>';
						$contenu .='</a>';
					$contenu .='</td>';
					$contenu .="<td>";
						$contenu .="<form method='post' action='' class='supp'>";
							$contenu .='<input type="hidden" name="actionInterne" value="supUnite">';
							$contenu .='<input type="hidden" name="id" value="'.$row['id'].'">';
							$contenu .="<button href='' class='btn btn-danger btn-icon-split'>";
								$contenu .="<span class='icon text-white-50'><i class='fas fa-trash'></i></span>";
								$contenu .="<span class='text hidden'>Supprimer</span>";
							$contenu .="</button>";							
						$contenu .="</form>";
					$contenu .="</td>";
				$contenu .="</tr>";
			}
		$contenu .= "</tbody>";
	$contenu .="</table>";	
?>