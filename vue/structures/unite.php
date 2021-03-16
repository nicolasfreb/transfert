<?php
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$unite = new Unite;
	
	$unite->chargeUnite($connexion, $_GET['unite']);
	
	
	$titre ='Unité';
	$button ='<a type="button" href="?action=Unites" class="btn btn-success btn-icon-split" style="margin-left:5%"><span class="icon text-white-50"><i class="fas fa-backward"></i></span><span class="text">Retour à la liste des unités</span></a>';
	$contenu = '<form method="POST" action="?action='.$_GET['action'].'">';	
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="titleRoom">Nom de l\'unité</label>';
			$contenu.= '<input type="text" id="nom" name="nom" class="form-control" placeholder="" value="'.$unite->uniteTitle.'" required>';
		$contenu.= '</div"><br>';			
			
		if($_GET['unite'] != 0){
			$contenu.= '<input type="hidden" name="actionInterne" value="modifUnite">';
			$contenu.= '<input type="hidden" name="id" value="'.$_GET['unite'].'">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fa fa-save"></i></span><span class="text">Enregistrer les modifications</span></button>';
		}
		else{
			$contenu.= '<input type="hidden" name="actionInterne" value="addUnite">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-save"></i></span><span class="text">Créer</span></button>';
		}
	$contenu.= '</form>';