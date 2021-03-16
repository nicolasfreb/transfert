<?php
	$pdo = new ConnexionBdd;
	$connexion = $pdo->connect($conf);
	$messages = new Messages;
	$messagesList = $messages->getMessages($connexion);
	
	$titre = 'Messages';
	$contenu = "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
		$contenu .="<thead>";
			$contenu .="<tr>";
				$contenu .="<th scope='col'>Id</th>";
				$contenu .="<th scope='col'>Room</th>";
				$contenu .="<th scope='col'>Message</th>";
				$contenu .="<th scope='col'>Date de creation</th>";
				$contenu .="<th scope='col'>Auteur</th>";
				$contenu .="<th scope='col'>Etat</th>";
				$contenu .="<th scope='col'>Actions</th>";
			$contenu .="</tr>";
		$contenu .="</thead>";
		$contenu .="<tbody>";
		while($row = $messagesList->fetch()) {
			$contenu .="<tr>";
				$contenu .="<td>";
					$contenu .=$row['messageId'];
				$contenu .="</td>";
				$contenu .="<td>";
					$contenu .=$row['roomTitle'];
				$contenu .="</td>";
				$contenu .="<td>";
					$contenu .= html_entity_decode($row['message']);
				$contenu .="</td>";
				$contenu .="<td>";
					$contenu .= date('d/m/Y H:i:s', $row['creationDate']/1000);
				$contenu .="</td>";
				$contenu .="<td>";
					$contenu .=$row['userLogin'];
				$contenu .="</td>";
				$contenu .="<td>";
					if($row['etatMessage'] == 0) $contenu .= 'Visible';
					else $contenu .= 'Caché';
				$contenu .="</td>";
				$contenu .="<td>";
				if($row['etatMessage'] == 0){
					$contenu .="<form method='post' action=''>";
						$contenu .='<input type="hidden" name="actionInterne" value="depMessage">';
						$contenu .='<input type="hidden" name="messageId" value="'.$row['messageId'].'">';
						$contenu .="<button href='' class='btn btn-danger btn-icon-split'>";
							$contenu .="<span class='icon text-white-50'><i class='fas fa-times-circle'></i></span>";
							$contenu .="<span class='text hidden'>Dépublier</span>";
						$contenu .="</button>";							
					$contenu .="</form>";
				}
				else{
					$contenu .="<form method='post' action=''>";
						$contenu .='<input type="hidden" name="actionInterne" value="publMessage">';
						$contenu .='<input type="hidden" name="messageId" value="'.$row['messageId'].'">';
						$contenu .="<button href='' class='btn btn-success btn-icon-split'>";
							$contenu .="<span class='icon text-white-50'><i class='fas fa-check-circle'></i></span>";
							$contenu .="<span class='text hidden'>Publier</span>";
						$contenu .="</button>";							
					$contenu .="</form>";
				}
				$contenu .="</td>";
			$contenu .="</tr>";
		}
		$contenu .="</tbody>";
	$contenu .= "</table>";
?>