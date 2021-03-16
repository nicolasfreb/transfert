<?php	
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$titre = 'Rooms';
	$rooms = new Rooms;
	$roomList = $rooms->getRooms($connexion);		
	$rooms->setRoomsAccess($connexion);		
	$acces = $rooms->RoomsAccess;
	$equivalenceAcces = array(0 => 'Aucun', 1 => 'Lecture', 2 => 'Lecture - écriture', 3 => 'Administration');
	
	$button = '<a type="button" href="?action=rooms&room=0" class="btn btn-success btn-icon-split" style="margin-left:5"><span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span><span class="text">Nouvelle room</span></a>';
	$contenu = "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
		$contenu .="<thead>";
			$contenu .="<tr>";
				$contenu .="<th scope='col'>Id</th>";
				$contenu .="<th scope='col'>Titre</th>";
				$contenu .="<th scope='col'>Salon</th>";
				$contenu .="<th scope='col'>Acces</th>";
				$contenu .="<th scope='col'>Voir</th>";
				$contenu .="<th scope='col'>Export</th>";
				$contenu .="<th scope='col'>Modifier</th>";
				$contenu .="<th scope='col'>Supprimer</th>";
			$contenu .="</tr>";
		$contenu .="</thead>";
		$contenu .="<tbody>";
			while($row = $roomList->fetch()) {
				if(isset($acces[$row['roomId']])) $accesRoom = $acces[$row['roomId']];
				else  $accesRoom ='';
				$contenu .="<tr>";
					$contenu .="<td>";
						$contenu .=$row['roomId'];
					$contenu .="</td>";
					$contenu .="<td>";
						$contenu .=$row['roomTitle'];
					$contenu .="</td>";
					$contenu .="<td>";
						$contenu .=$row['salonTitle'];
					$contenu .="</td>";
					$infoHtml ='<ul>';
					if(isset($acces[$row['roomId']])){
						foreach($accesRoom as $accesGroupe) {
							$infoHtml .= '<li>'.$accesGroupe['titre'].' : '.$equivalenceAcces[$accesGroupe['acces']].'</li>';
						}
					}
					$infoHtml .='</ul>';
					$contenu .='<td>';
					$contenu .='<button type="button" class="btn btn-secondary  btn-icon-split" data-toggle="tooltip" data-placement="right" title="'.$infoHtml.'">';
						$contenu .='<span class="icon text-white-50"><i class="fas fa-search"></i></span>';
						$contenu .='<span class="text hidden">Voir les acces</span>';
					$contenu .='</button></td>';
					$contenu .='<td>';
						$contenu .='<a type="button" target="_blank" class="btn btn-success btn-icon-split"  href="'.$conf['adresseredirect'].'/chat/'.$row['salonId'].'/'.$row['roomId'].'">';
							$contenu .='<span class="icon text-white-50"><i class="fas fa-share"></i></span>';
							$contenu .='<span class="text hidden">Voir la room</span>';
						$contenu .='</a>';
					$contenu .='</td>';
					$contenu .='<td>';
						$contenu .='<a type="button" class="btn btn-warning btn-icon-split" target="_blank" href="?action=roomsdl&room='.$row['roomId'].'&tmpl=cache">';
							$contenu .='<span class="icon text-white-50"><i class="fas fa-cog"></i></span>';
							$contenu .='<span class="text hidden">Exporter</span>';
						$contenu .='</a>';
					$contenu .='</td>';
					$contenu .='<td>';
						$contenu .='<a type="button" class="btn btn-primary btn-icon-split"  href="?action=rooms&room='.$row['roomId'].'">';
							$contenu .='<span class="icon text-white-50"><i class="fas fa-cog"></i></span>';
							$contenu .='<span class="text hidden">Modifier</span>';
						$contenu .='</a>';
					$contenu .='</td>';
					$contenu .="<td>";
						$contenu .="<form method='post' action='' class='supp'>";
							$contenu .='<input type="hidden" name="actionInterne" value="supRoom">';
							$contenu .='<input type="hidden" name="roomId" value="'.$row['roomId'].'">';
							$contenu .="<button class='btn btn-danger btn-icon-split'>";
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