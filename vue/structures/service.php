<?php
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$unites = new Unites;
	$service = new Service;
	$groupes = new Groupes;
	
	$service->chargeService($connexion, $_GET['service']);
	$service->chargeAccess($connexion);
	
	$unites = $unites->getUnites($connexion);
	$groupesList = $groupes->chargeGroupes($connexion);
	
	if(!isset($_SERVER['HTTP_REFERER'])) $_SERVER['HTTP_REFERER'] = '?action=services';
	
	$titre ='Services';
	$button ='<a type="button" href="'.$_SERVER['HTTP_REFERER'].'" class="btn btn-success btn-icon-split" style="margin-left:5%"><span class="icon text-white-50"><i class="fas fa-backward"></i></span><span class="text">Retour</span></a>';
	$contenu = '<form method="POST" action="'.$_SERVER['HTTP_REFERER'].'">';	
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="TitleService">Nom du service</label>';
			$contenu.= '<input type="text" id="TitleService" name="serviceTitle" class="form-control" placeholder="" value="'.$service->nom.'" required>';
		$contenu.= '</div">';	
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="TitleService">Position X</label>';
			$contenu.= '<input type="text" id="posx" name="posx" class="form-control" placeholder="" value="'.$service->posX.'" required>';
		$contenu.= '</div">';
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="TitleService">Position Y</label>';
			$contenu.= '<input type="text" id="posy" name="posy" class="form-control" placeholder="" value="'.$service->posY.'" required>';
		$contenu.= '</div">';		
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="titleUnite">Unités</label>';
			$contenu.= '<select class="form-control"name="uniteId" id="Unite" required>';
				while($row = $unites->fetch()) { 
					if($service->uniteId == $row['id']){
						$contenu.= ' <option selected="selected" value="'.$row['id'].'">'.$row['nom'].'</option>';
					}
					else $contenu.= ' <option value="'.$row['id'].'">'.$row['nom'].'</option>';
				}
			$contenu.= '</select>';	
		$contenu.= '</div>';		
		$contenu.= '<br>';		
		$contenu.= '<div class="form-group"><table>';
			while($row = $groupesList->fetch()) { 
				$contenu .= '<tr><td>'.$row['groupeTitre'].' </td><td></td><td>';
				$contenu.= '<select class="form-control" name="groupeAcces['.$row['groupeId'].']" id="groupe'.$row['groupeTitre'].'">';
					if(isset($service->access[$row['groupeId']])){
						if($service->access[$row['groupeId']] == 0) $contenu.= '<option selected value="0">Aucun</option>';
						else $contenu.= '<option value="0">Aucun</option>';
						if($service->access[$row['groupeId']] == 1) $contenu.= '<option selected value="1">Lecture</option>';
						else $contenu.= '<option value="1">Lecture</option>';
						if($service->access[$row['groupeId']] == 2)$contenu.= '<option selected value="2">Lecture - Ecriture</option>';
						else $contenu.= '<option value="2">Lecture - Ecriture</option>';
						if($service->access[$row['groupeId']] == 3)$contenu.= '<option selected value="3">Administration</option>';
						else $contenu.= '<option value="3">Administration</option>';
					}
					else{
						$contenu.= '<option value="0">Aucun</option>';
						$contenu.= '<option value="1">Lecture</option>';
						$contenu.= '<option value="2">Lecture - Ecriture</option>';
						$contenu.= '<option value="3">Administration</option>';
					}
				$contenu.= '</select></td></tr>';
			}
		$contenu.= '</table></div>';	
			
		if($_GET['service'] != 0){
			$contenu.= '<input type="hidden" name="actionInterne" value="modifService">';
			$contenu.= '<input type="hidden" name="id" value="'.$service->id.'">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fa fa-save"></i></span><span class="text">Enregistrer les modifications</span></button>';
		}
		else{
			$contenu.= '<input type="hidden" name="actionInterne" value="addService">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-save"></i></span><span class="text">Créer</span></button>';
		}
	$contenu.= '</form>';