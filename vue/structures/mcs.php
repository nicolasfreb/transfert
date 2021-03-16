<?php	
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$titre = 'Calendrier Mains Courantes Journalières';
	$mcs = new Mcs;
	$mcList = $mcs->getMcs($connexion);		
	$mcs->setMcsAccess($connexion);		
	$acces = $mcs->mcsAccess;
	$equivalenceAcces = array(0 => 'Aucun', 1 => 'Lecture', 2 => 'Lecture - écriture', 3 => 'Administration');
	
	$button = '<a type="button" href="?action=mcs&mc=0" class="btn btn-success btn-icon-split" style="margin-left:5"><span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span><span class="text">Nouveau calendrier</span></a>';
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
			while($row = $mcList->fetch()) {
				if(isset($acces[$row['id_calendrier']])) $accesMc = $acces[$row['id_calendrier']];
				else  $accesMc ='';
				$contenu .="<tr>";
					$contenu .="<td>";
						$contenu .=$row['id_calendrier'];
					$contenu .="</td>";
					$contenu .="<td>";
						$contenu .=$row['nom'];
					$contenu .="</td>";
					$infoHtml ='<ul>';
					if(isset($acces[$row['id_calendrier']])){
						foreach($accesMc as $accesGroupe) {
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
						$contenu .='<a type="button" target="_blank" class="btn btn-success btn-icon-split"  href="'.$conf['adresseredirect'].'/calendrier/'.$row['id_calendrier'].'">';
							$contenu .='<span class="icon text-white-50"><i class="fas fa-share"></i></span>';
							$contenu .='<span class="text hidden">Voir le calendrier de main courante</span>';
						$contenu .='</a>';
					$contenu .='</td>';
					$contenu .='<td>';
						$contenu .='<a type="button" class="btn btn-primary btn-icon-split"  href="?action=mcs&mc='.$row['id_calendrier'].'">';
							$contenu .='<span class="icon text-white-50"><i class="fas fa-cog"></i></span>';
							$contenu .='<span class="text hidden">Modifier</span>';
						$contenu .='</a>';
					$contenu .='</td>';
					$contenu .="<td>";
						$contenu .="<form method='post' action='' class='supp'>";
							$contenu .='<input type="hidden" name="actionInterne" value="supMc">';
							$contenu .='<input type="hidden" name="mcId" value="'.$row['id_calendrier'].'">';
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