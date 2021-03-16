<?php	
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$titre = 'Services';
	$services = new Services;
	$unites = new Unites;
	$uniteList = $unites->listUnite($connexion);
	
	$serviceList = $services->getServices($connexion);		
	$services->setServicesAccess($connexion);		
	$acces = $services->servicesAccess;
	$equivalenceAcces = array(0 => 'Aucun', 1 => 'Lecture', 2 => 'Lecture - écriture', 3 => 'Administration');
	
	$button = '<a type="button" href="?action=services&service=0" class="btn btn-success btn-icon-split" style="margin-left:5"><span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span><span class="text">Nouveau service</span></a>';
	$contenu = "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
		$contenu .="<thead>";
			$contenu .="<tr>";
				$contenu .="<th scope='col'>Id</th>";
				$contenu .="<th scope='col'>Titre</th>";
				$contenu .="<th scope='col'>Unité</th>";
				$contenu .="<th scope='col'>Position X</th>";
				$contenu .="<th scope='col'>Position Y</th>";
				$contenu .="<th scope='col'>Acces</th>";
				$contenu .="<th scope='col'>Voir</th>";
				$contenu .="<th scope='col'>Modifier</th>";
				$contenu .="<th scope='col'>Supprimer</th>";
			$contenu .="</tr>";
		$contenu .="</thead>";
		$contenu .="<tbody>";
			while($row = $serviceList->fetch()) {
				if(isset($acces[$row['id']])) $accesService = $acces[$row['id']];
				else $accesService = '';
				$contenu .="<tr>";
					$contenu .="<td>";
						$contenu .=$row['id'];
					$contenu .="</td>";
					$contenu .="<td>";
						$contenu .=$row['nom'];
					$contenu .="</td>";
					$contenu .="<td>";
						$contenu .=$uniteList[$row['unite_id']]['nom'].'<a href="?action=services&map='.$row['unite_id'].'"><img style="width:80px;height:auto;" src="img/carte.png"></a>';
					$contenu .="</td>";
					$contenu .="<td>";
						$contenu .=$row['posx']. 'px';
					$contenu .="</td>";
					$contenu .="<td>";
						$contenu .=$row['posy'].' px';
					$contenu .="</td>";
					$infoHtml ='<ul>';
					if(isset($acces[$row['id']])){
						foreach($accesService as $accesGroupe) {
							$infoHtml .= '<li>'.$accesGroupe['titre'].' : '.$equivalenceAcces[$accesGroupe['acces']].'</li>';
						}
					}	
					$infoHtml .='</ul>';
					$contenu .='<td>';
					$contenu .='<button type="button" class="btn btn-secondary  btn-icon-split" data-toggle="tooltip" data-placement="right" title="'.$infoHtml.'">';
						$contenu .='<span class="icon text-white-50"><i class="fas fa-search"></i></span>';
						$contenu .='<span class="text hidden">Voir les accès</span>';
					$contenu .='</button></td>';
					$contenu .='<td>';
						$contenu .='<a type="button"  target="_blank" class="btn btn-success btn-icon-split"  href="'.$conf['adresseredirect'].'/service/'.$row['id'].'">';
							$contenu .='<span class="icon text-white-50"><i class="fas fa-share"></i></span>';
							$contenu .='<span class="text hidden">Voir le service</span>';
						$contenu .='</a>';
					$contenu .='</td>';
					$contenu .='<td>';
						$contenu .='<a type="button" class="btn btn-primary btn-icon-split"  href="?action=services&service='.$row['id'].'">';
							$contenu .='<span class="icon text-white-50"><i class="fas fa-cog"></i></span>';
							$contenu .='<span class="text hidden">Modifier</span>';
						$contenu .='</a>';
					$contenu .='</td>';
					$contenu .="<td>";
						$contenu .="<form method='post' action='' class='supp'>";
							$contenu .='<input type="hidden" name="actionInterne" value="supService">';
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