<?php
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$salon = new Salon;
	$groupes = new Groupes;
	
	$salon->chargeSalon($connexion, $_GET['salon']);
	$salon->chargeAccess($connexion);
	$groupesList = $groupes->chargeGroupes($connexion);
	
	$titre ='Salon';
	$button ='<a type="button" href="?action=salons" class="btn btn-success btn-icon-split" style="margin-left:5%"><span class="icon text-white-50"><i class="fas fa-backward"></i></span><span class="text">Retour à la liste des salons</span></a>';
	$contenu = '<form method="POST" action="?action='.$_GET['action'].'">';	
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="titleRoom">Nom du Salon</label>';
			$contenu.= '<input type="text" id="titleSalon" name="salonTitle" class="form-control" placeholder="" value="'.$salon->salonTitle.'" required>';
		$contenu.= '</div">';				
		$contenu.= '<br>';		
		$contenu.= '<div class="form-group"><table>';
			while($row = $groupesList->fetch()) { 
				$contenu .= '<tr><td>'.$row['groupeTitre'].' </td><td></td><td>';
				$contenu.= '<select class="form-control" name="groupeAcces['.$row['groupeId'].']" id="groupe'.$row['groupeTitre'].'">';
					if(isset($salon->accessSalon[$row['groupeId']])){
						if($salon->accessSalon[$row['groupeId']] == 0) $contenu.= '<option selected value="0">Aucun</option>';
						else $contenu.= '<option value="0">Aucun</option>';
						if($salon->accessSalon[$row['groupeId']] == 1) $contenu.= '<option selected value="1">Lecture</option>';
						else $contenu.= '<option value="1">Lecture</option>';
						if($salon->accessSalon[$row['groupeId']] == 2)$contenu.= '<option selected value="2">Lecture - Ecriture</option>';
						else $contenu.= '<option value="2">Lecture - Ecriture</option>';
						if($salon->accessSalon[$row['groupeId']] == 3)$contenu.= '<option selected value="3">Administration</option>';
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
			
		if($_GET['salon'] != 0){
			$contenu.= '<input type="hidden" name="actionInterne" value="modifSalon">';
			$contenu.= '<input type="hidden" name="salonId" value="'.$salon->salonId.'">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fa fa-save"></i></span><span class="text">Enregistrer les modifications</span></button>';
		}
		else{
			$contenu.= '<input type="hidden" name="actionInterne" value="addSalon">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-save"></i></span><span class="text">Créer</span></button>';
		}
	$contenu.= '</form>';