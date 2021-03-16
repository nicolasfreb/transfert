<?php
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$User = new user;
	$User->chargeUser($connexion, $_GET['user']);
	$User-> structureUser();
	$userId = $User->getUserID();
	$userLogin = $User->getUserLogin();
	$userActif = $User->getUserActif();
	$userGroupes = $User->getUserGroupes();
	
	$allGroupe = new groupes;
	$allGroupe->chargeGroupes($connexion);
	$allGroupe->groupeToArray();
	$groupes = $allGroupe->getGroupe();

	$titre = 'Utilisateur '.$userLogin;
	
	$button ='<a type="button" href="?action=utilisateurs" class="btn btn-success btn-icon-split" style="margin-left:5%"><span class="icon text-white-50"><i class="fas fa-backward"></i></span><span class="text">Retour à la liste des utilisateurs</span></a>';
	$contenu = '<form method="POST" action="?action='.$_GET['action'].'">';	
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="titleRoom">Nom de l\'utilisateur</label>';
			$contenu.= '<input type="text" id="userLogin" name="userLogin" class="form-control" placeholder="" value="'.$userLogin.'" required>';
		$contenu.= '</div">';		
		$contenu.= '<div class="form-group">';
			$contenu.= '<label for="titleRoom">Activation</label>';
			$contenu.= '<select class="form-control"name="userActif" id="userActif" required>';
				if($userActif == 0){
					$contenu.= ' <option selected="selected" value="0">Inactif</option>';
					$contenu.= ' <option value="1">Actif</option>';
				}
				else{
					$contenu.= ' <option value="0">Inactif</option>';
					$contenu.= ' <option  selected="selected" value="1">Actif</option>';
				}
			$contenu.= '</select>';	
		$contenu.= '</div>'	;	
		$contenu.= '<div class="form-group">';			
			foreach($groupes as $groupe) {
				if(in_array($groupe['groupeId'], $userGroupes)) $contenu.= '<div class="checkbox"><label><input checked="checked" type="checkbox" value="'.$groupe['groupeId'].'" name="userGroupe[]"> '.$groupe['groupeTitre'].'</label></div>';
				else $contenu.= '<div class="checkbox"><label><input type="checkbox" value="'.$groupe['groupeId'].'" name="userGroupe[]"> '.$groupe['groupeTitre'].'</label></div>';
			}
		$contenu.= '</div>';		
		$contenu.= '<br>';		
		$contenu.= '</div>';		
			
		if($_GET['user'] != 0){
			$contenu.= '<input type="hidden" name="actionInterne" value="modifUser">';
			$contenu.= '<input type="hidden" name="userId" value="'.$userId.'">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fa fa-save"></i></span><span class="text">Enregistrer les modifications</span></button>';
		}
		else{
			$contenu.= '<input type="hidden" name="actionInterne" value="addUser">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-save"></i></span><span class="text">Créer</span></button>';
		}
	$contenu.= '</form>';
?>