<?php
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$salons = new Salons;
	$room = new Room;
	$groupes = new Groupes;
	
	$room->chargeRoom($connexion, $_GET['room']);
	$room->chargeAccess($connexion);
	$salonsList = $salons->getSalons($connexion);
	$groupesList = $groupes->chargeGroupes($connexion);
	
	$titre ='Room';
	$button ='<a type="button" href="?action=rooms" class="btn btn-success btn-icon-split" style="margin-left:5%"><span class="icon text-white-50"><i class="fas fa-backward"></i></span><span class="text">Retour à la liste des rooms</span></a>';
	$contenu = '<form method="POST" action="?action='.$_GET['action'].'">';	
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="titleRoom">Nom de la room</label>';
			$contenu.= '<input type="text" id="titleRoom" name="roomTitle" class="form-control" placeholder="" value="'.$room->roomTitle.'" required>';
		$contenu.= '</div">';		
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="titleRoom">Salon</label>';
			$contenu.= '<select class="form-control"name="salonId" id="Salon" required>';
				while($row = $salonsList->fetch()) { 
					if($room->salonId == $row['salonId']){
						$contenu.= ' <option selected="selected" value="'.$row['salonId'].'">'.$row['salonTitle'].'</option>';
					}
					else $contenu.= ' <option value="'.$row['salonId'].'">'.$row['salonTitle'].'</option>';
				}
			$contenu.= '</select>';	
		$contenu.= '</div>';		
		$contenu.= '<br>';		
		$contenu.= '<div class="form-group"><table>';
			while($row = $groupesList->fetch()) { 
				$contenu .= '<tr><td>'.$row['groupeTitre'].' </td><td></td><td>';
				$contenu.= '<select class="form-control" name="groupeAcces['.$row['groupeId'].']" id="groupe'.$row['groupeTitre'].'">';
					if(isset($room->accessRoom[$row['groupeId']])){
						if($room->accessRoom[$row['groupeId']] == 0) $contenu.= '<option selected value="0">Aucun</option>';
						else $contenu.= '<option value="0">Aucun</option>';
						if($room->accessRoom[$row['groupeId']] == 1) $contenu.= '<option selected value="1">Lecture</option>';
						else $contenu.= '<option value="1">Lecture</option>';
						if($room->accessRoom[$row['groupeId']] == 2)$contenu.= '<option selected value="2">Lecture - Ecriture</option>';
						else $contenu.= '<option value="2">Lecture - Ecriture</option>';
						if($room->accessRoom[$row['groupeId']] == 3)$contenu.= '<option selected value="3">Administration</option>';
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
			
		if($_GET['room'] != 0){
			$contenu.= '<input type="hidden" name="actionInterne" value="modifRoom">';
			$contenu.= '<input type="hidden" name="roomId" value="'.$room->roomId.'">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fa fa-save"></i></span><span class="text">Enregistrer les modifications</span></button>';
		}
		else{
			$contenu.= '<input type="hidden" name="actionInterne" value="addRoom">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-save"></i></span><span class="text">Créer</span></button>';
		}
	$contenu.= '</form>';