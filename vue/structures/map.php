<script type="text/javascript" src="js/pages/map.js"></script>
<?php	
	if(!isset($_SERVER['HTTP_REFERER'])) $_SERVER['HTTP_REFERER'] = '?action=services';
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$titre = 'Services';
	
	$unites = new Unites;
	$service = new Service;
	$groupes = new Groupes;	
	$services = new Services;
	
	$unites = $unites->getUnites($connexion);
	$groupesList = $groupes->chargeGroupes($connexion);	
	
	echo '<script text="javascript">var map = '.$_GET['map'].';</script>';
	
	$serviceList = $services->getServicesMap($connexion, $_GET['map']);	
	
	$button = '<a type="button" href="?action=unites" class="btn btn-success btn-icon-split" style="margin-left:5%"><span class="icon text-white-50"><i class="fas fa-backward"></i></span><span class="text">Retour</span></a><button type="button" id="opener" class="btn btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-plus-circle"></i></span><span class="text">Nouveau</span></button>';
	$contenu = '<div style="position:relative;display:table;height:1500px;font-size:15px;font-weight:bold;color:#001387;">';
	while($row = $serviceList->fetch()) {
		$contenu .='<div draggable="true" id="'.$row['id'].'" class="ui-widget-content draggable element" style=" cursor: move;box-shadow :0px 0px 10px #ccc;background: linear-gradient(#eee, #ccc);width:150px;height:60px;text-align:center;border:1px solid #ccc;position:absolute;display:block;left:'.$row['posx']. 'px'.';top:'.$row['posy']. 'px'.';">'.$row['nom'].'<a class="btn btn-primary btn-icon-split" style="position:absolute;top:0;right:0;" href="?action=services&service='.$row['id'].'"><span class="icon text-white-50" style="padding:2px;"><i class="fas fa-cog"></i></span></a></div>';
	}
	$contenu .= '</div>';
	$contenu .= '<div id="dialog" title="Nouveau service">';
		$contenu .= '<form id="myForm" method="POST" action="?action='.$_GET['action'].'">';	
			$contenu.= '<div class="form-group">';
				$contenu.= '<label for="TitleService">Nom du service</label>';
				$contenu.= '<input type="text" id="TitleService" name="serviceTitle" class="form-control" placeholder="" value="'.$service->nom.'" required>';
			$contenu.= '</div">';	
			$contenu.= '<div class="form-group">';
				$contenu.= '<input type="hidden" id="posx" name="posx" class="form-control" placeholder="" value="0" required>';
			$contenu.= '</div">';
			$contenu.= '<div class="form-group">';
				$contenu.= '<input type="hidden" id="posy" name="posy" class="form-control" placeholder="" value="0" required>';
			$contenu.= '</div">';		
			$contenu.= '<div class="form-group">';
				$contenu.= '<input type="hidden" id="uniteId" name="uniteId" class="form-control" placeholder="" value="'.$_GET['map'].'" required>';
			$contenu.= '</div>';		
			$contenu.= '<br>';		
			$contenu.= '<div class="form-group"><table>';
				while($row = $groupesList->fetch()) { 
					$contenu .= '<tr><td>'.$row['groupeTitre'].' </td><td></td><td>';
					$contenu.= '<select class="form-control" name="groupeAcces['.$row['groupeId'].']" id="groupe'.$row['groupeTitre'].'">';
						$contenu.= '<option value="0">Aucun</option>';
						$contenu.= '<option value="1">Lecture</option>';
						$contenu.= '<option value="2">Lecture - Ecriture</option>';
						$contenu.= '<option value="3">Administration</option>';
					$contenu.= '</select></td></tr>';
				}
			$contenu.= '</table></div>';			
			$contenu.= '<input type="hidden" name="actionInterne" value="addService">';
			$contenu.='<button type="submit" class="btn btn-primary btn-icon-split"><span class="icon text-white-50"><i class="fas fa-save"></i></span><span class="text">Créer</span></button>';
		$contenu.= '</form>';
	$contenu .= '</div>';
?>