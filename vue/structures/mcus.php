<?php	
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$titre = 'Mains Courantes Unique';
	$mcus = new Mcus;
	$mcuList = $mcus->getMcus($connexion);		
	$mcus->setMcusAccess($connexion);		
	$acces = $mcus->mcusAccess;
	$equivalenceAcces = array(0 => 'Aucun', 1 => 'Lecture', 2 => 'Lecture - écriture', 3 => 'Administration');
	
	$button = '<a type="button" href="?action=mcus&mcu=0" class="btn btn-success btn-icon-split" style="margin-left:5"><span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span><span class="text">Nouvelle main courante</span></a>';
	$contenu = "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
		$contenu .="<thead>";
			$contenu .="<tr>";
				$contenu .="<th scope='col'>Id</th>";
				$contenu .="<th scope='col'>Titre</th>";
				$contenu .="<th scope='col'>Acces</th>";
				$contenu .="<th scope='col'>Voir</th>";
				$contenu .="<th scope='col'>Modifier</th>";
				$contenu .="<th scope='col'>Supprimer</th>";
			$contenu .="</tr>";
		$contenu .="</thead>";
		$contenu .="<tbody>";
			while($row = $mcuList->fetch()) {
				if(isset($acces[$row['id_evenement']])) $accesMcu = $acces[$row['id_evenement']];
				else  $accesMcu ='';
				$contenu .="<tr>";
					$contenu .="<td>";
						$contenu .=$row['id_evenement'];
					$contenu .="</td>";
					$contenu .="<td>";
						$contenu .=$row['titre_evenement'];
					$contenu .="</td>";
					$infoHtml ='<ul>';
					if(isset($acces[$row['id_evenement']])){
						foreach($accesMcu as $accesGroupe) {
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
						$contenu .='<a type="button" target="_blank" class="btn btn-success btn-icon-split"  href="'.$conf['adresseredirect'].'/mc/'.$row['id_evenement'].'">';
							$contenu .='<span class="icon text-white-50"><i class="fas fa-share"></i></span>';
							$contenu .='<span class="text hidden">Voir la Main courante</span>';
						$contenu .='</a>';
					$contenu .='</td>';
					$contenu .='<td>';
						$contenu .='<a type="button" class="btn btn-primary btn-icon-split"  href="?action=mcus&mcu='.$row['id_evenement'].'">';
							$contenu .='<span class="icon text-white-50"><i class="fas fa-cog"></i></span>';
							$contenu .='<span class="text hidden">Modifier</span>';
						$contenu .='</a>';
					$contenu .='</td>';
					$contenu .="<td>";
						$contenu .="<form method='post' action='' class='supp'>";
							$contenu .='<input type="hidden" name="actionInterne" value="supMcu">';
							$contenu .='<input type="hidden" name="mcuId" value="'.$row['id_evenement'].'">';
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