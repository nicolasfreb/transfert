<?php
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	
	$users = new users;
	$users->chargementUser($connexion);
	$users->setUsersInArray();
	$listUsers = $users->getUsers();
	
	$titre = 'Utilisateurs';
	$button = '<a type="button" href="?action=utilisateurs&user=0" class="btn btn-success btn-icon-split" style="margin-left:5"><span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span><span class="text">Nouvelle Utilisateur</span></a>';
	$contenu = "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
		$contenu .="<thead>";
			$contenu .="<tr>";
				$contenu .="<th scope='col'>Id</th>";
				$contenu .="<th scope='col'>Utilisateurs</th>";
				$contenu .="<th scope='col'>Groupes</th>";
				$contenu .="<th scope='col'>Modifier</th>";
				$contenu .="<th scope='col'>Supprimer</th>";
			$contenu .="</tr>";
		$contenu .="</thead>";
		$contenu .="<tbody>";
			foreach($listUsers as $row) {
				$contenu .="<tr>";
					$contenu .="<td>";
						$contenu .=$row['userId'];
					$contenu .="</td>";
					$contenu .="<td>";
						$contenu .=$row['userLogin'];
					$contenu .="</td>";
					$infoHtml ='<ul>';
						if(isset($row['groupes'])){
							foreach($row['groupes'] as $accesGroupe) {
								$infoHtml .= '<li>'.$accesGroupe['titre'].'</li>';
							}
						}
					$infoHtml .='</ul>';
					$contenu .='<td>';
					$contenu .='<button type="button" class="btn btn-secondary  btn-icon-split" data-toggle="tooltip" data-placement="right" title="'.$infoHtml.'">';
						$contenu .='<span class="icon text-white-50"><i class="fas fa-search"></i></span>';
						$contenu .='<span class="text">Voir les acces</span>';
					$contenu .='</button></td>';
					$contenu .='<td>';
						$contenu .='<a type="button" class="btn btn-primary btn-icon-split"  href="?action=utilisateurs&user='.$row['userId'].'">';
							$contenu .='<span class="icon text-white-50"><i class="fas fa-cog"></i></span>';
							$contenu .='<span class="text">Modifier</span>';
						$contenu .='</a>';
					$contenu .='</td>';
					$contenu .="<td>";
						$contenu .="<form method='post' action=''>";
							$contenu .='<input type="hidden" name="actionInterne" value="supUser">';
							$contenu .='<input type="hidden" name="userId" value="'.$row['userId'].'">';
							$contenu .="<button href='' class='btn btn-danger btn-icon-split'>";
								$contenu .="<span class='icon text-white-50'><i class='fas fa-trash'></i></span>";
								$contenu .="<span class='text'>Supprimer</span>";
							$contenu .="</button>";							
						$contenu .="</form>";
					$contenu .="</td>";
				$contenu .="</tr>";
			}
		$contenu .= "</tbody>";
	$contenu .="</table>";	
	
?>