<?php
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$mcu = new Mcu;
	$groupes = new Groupes;
	
	$mcu->chargeMcu($connexion, $_GET['mcu']);
	$mcu->chargeAccess($connexion);
	
	$groupesList = $groupes->chargeGroupes($connexion);
	
	$titre ='Main courante';
	$button ='<a type="button" href="?action=mcus" class="btn btn-success btn-icon-split" style="margin-left:5%"><span class="icon text-white-50"><i class="fas fa-backward"></i></span><span class="text">Retour à la liste des mains courantes</span></a>';
	$contenu = '<form method="POST" action="?action='.$_GET['action'].'">';	
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="titleMc">Nom de la main courante</label>';
			$contenu.= '<input type="text" id="titleMc" name="mcuTitle" class="form-control" placeholder="" value="'.$mcu->mcuTitle.'" required>';
		$contenu.= '</div">';
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="etatMc">Verrouillage de la main courante</label>';
			$contenu.= '<select class="form-control" name="mcuEtat" id="etatMc">';
				$contenu.= '<option value="0">Non</option>';
				if(isset($mcu->etat) && $mcu->etat == 1) $contenu.= '<option selected="selected" value="1">Oui</option>';
				else $contenu.= '<option value="1">Oui</option>';
				
			$contenu.= '</select>';
		$contenu.= '</div">';		
				
		$contenu.= '<br>';		
		$contenu.= '<div class="form-group"><table>';
			while($row = $groupesList->fetch()) { 
				$contenu .= '<tr><td>'.$row['groupeTitre'].' </td><td></td><td>';
				$contenu.= '<select class="form-control" name="groupeAcces['.$row['groupeId'].']" id="groupe'.$row['groupeTitre'].'">';
					if(isset($mcu->accessMcu[$row['groupeId']])){
						if($mcu->accessMcu[$row['groupeId']] == 0) $contenu.= '<option selected value="0">Aucun</option>';
						else $contenu.= '<option value="0">Aucun</option>';
						if($mcu->accessMcu[$row['groupeId']] == 1) $contenu.= '<option selected value="1">Lecture</option>';
						else $contenu.= '<option value="1">Lecture</option>';
						if($mcu->accessMcu[$row['groupeId']] == 2)$contenu.= '<option selected value="2">Lecture - Ecriture</option>';
						else $contenu.= '<option value="2">Lecture - Ecriture</option>';
						if($mcu->accessMcu[$row['groupeId']] == 3)$contenu.= '<option selected value="3">Administration</option>';
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
			
		if($_GET['mcu'] != 0){
			$contenu.= '<input type="hidden" name="actionInterne" value="modifMcu">';
			$contenu.= '<input type="hidden" name="mcuId" value="'.$mcu->mcuId.'">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fa fa-save"></i></span><span class="text">Enregistrer les modifications</span></button>';
		}
		else{
			$contenu.= '<input type="hidden" name="actionInterne" value="addMcu">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-save"></i></span><span class="text">Créer</span></button>';
		}
	$contenu.= '</form>';