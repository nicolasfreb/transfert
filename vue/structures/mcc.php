<?php
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$mcc = new mcc;	
	$mcc->chargemcc($connexion, $_GET['mcc']);
	
	$titre ='Main courante';
	$button ='<a type="button" href="?action=mccs" class="btn btn-success btn-icon-split" style="margin-left:5%"><span class="icon text-white-50"><i class="fas fa-backward"></i></span><span class="text">Retour à la liste des mains courantes</span></a>';
	$contenu = '<form method="POST" action="?action='.$_GET['action'].'">';	
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="titleMc">Nom de la main courante</label>';
			$contenu.= '<input type="text" id="titleMc" name="mccTitle" class="form-control" placeholder="" value="'.$mcc->mccTitle.'" required>';
		$contenu.= '</div">';
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="etatMc">Verrouillage de la main courante</label>';
			$contenu.= '<select class="form-control" name="mccEtat" id="etatMc">';
				$contenu.= '<option value="0">Non</option>';
				if(isset($mcc->etat) && $mcc->etat == 1) $contenu.= '<option selected="selected" value="1">Oui</option>';
				else $contenu.= '<option value="1">Oui</option>';
				
			$contenu.= '</select>';
		$contenu.= '</div">';				
		$contenu.= '<br>';				
			
		if($_GET['mcc'] != 0){
			$contenu.= '<input type="hidden" name="actionInterne" value="modifMcc">';
			$contenu.= '<input type="hidden" name="mccId" value="'.$mcc->mccId.'">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fa fa-save"></i></span><span class="text">Enregistrer les modifications</span></button>';
		}
	$contenu.= '</form>';