<?php
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$mc = new Mc;
	$groupes = new Groupes;
	
	$mc->chargeMc($connexion, $_GET['mc']);
	$mc->chargeAccess($connexion);
	
	$groupesList = $groupes->chargeGroupes($connexion);
	
	$titre ='Main courante';
	$button ='<a type="button" href="?action=mcs" class="btn btn-success btn-icon-split" style="margin-left:5%"><span class="icon text-white-50"><i class="fas fa-backward"></i></span><span class="text">Retour à la liste des mains courantes</span></a>';
	$contenu = '<form method="POST" action="?action='.$_GET['action'].'">';	
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="titleMc">Nom de la main courante</label>';
			$contenu.= '<input type="text" id="titleMc" name="mcTitle" class="form-control" placeholder="" value="'.$mc->mcTitle.'" required>';
		$contenu.= '</div">';
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="etatMc">Verrouillage par date</label>';
			$contenu.= '<select class="form-control" name="mcEtat" id="etatMc">';
				$contenu.= '<option value="0">Non</option>';
				if(isset($mc->etat) && $mc->etat == 1) $contenu.= '<option selected="selected" value="1">Oui</option>';
				else $contenu.= '<option value="1">Oui</option>';
				
			$contenu.= '</select>';
		$contenu.= '</div">';		
				
		$contenu.= '<br>';		
		$contenu.= '<div class="form-group"><table>';
			while($row = $groupesList->fetch()) { 
				$contenu .= '<tr><td>'.$row['groupeTitre'].' </td><td></td><td>';
				$contenu.= '<select class="form-control" name="groupeAcces['.$row['groupeId'].']" id="groupe'.$row['groupeTitre'].'">';
					if(isset($mc->accessMc[$row['groupeId']])){
						if($mc->accessMc[$row['groupeId']] == 0) $contenu.= '<option selected value="0">Aucun</option>';
						else $contenu.= '<option value="0">Aucun</option>';
						if($mc->accessMc[$row['groupeId']] == 1) $contenu.= '<option selected value="1">Lecture</option>';
						else $contenu.= '<option value="1">Lecture</option>';
						if($mc->accessMc[$row['groupeId']] == 2)$contenu.= '<option selected value="2">Lecture - Ecriture</option>';
						else $contenu.= '<option value="2">Lecture - Ecriture</option>';
						if($mc->accessMc[$row['groupeId']] == 3)$contenu.= '<option selected value="3">Administration</option>';
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
			
		if($_GET['mc'] != 0){
			$contenu.= '<input type="hidden" name="actionInterne" value="modifMc">';
			$contenu.= '<input type="hidden" name="mcId" value="'.$mc->mcId.'">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fa fa-save"></i></span><span class="text">Enregistrer les modifications</span></button>';
		}
		else{
			$contenu.= '<input type="hidden" name="actionInterne" value="addMc">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-save"></i></span><span class="text">Créer</span></button>';
		}
	$contenu.= '</form>';