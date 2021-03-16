<?php
	if(isset($_GET['tmpl']) and $_GET['tmpl'] == 'cache'){
		require('outils/fpdf/fpdf.php');
		$pdo = new ConnexionBdd;
		$connexion = $pdo->connect($conf);
		$room = new Room;	
		$room->chargeRoom($connexion,$_GET['room']);
		$messages = $room->getMessage($connexion, $_GET['room']);
		
		class PDF extends FPDF{		
			
			function addHeader($roomTitle){
				$this->SetFont('Arial','B',15); 
				// Décalage à droite
				$this->Cell(80);
				// Titre
				$this->Cell(30,10, $roomTitle );
				// Saut de ligne
				$this->Ln(20);
			}
			
		}
		
		$pdf = new PDF();
		$pdf->AddPage();
		$pdf->addHeader('Room '.$room->roomTitle);
		foreach ($messages as $message){
			$message['message'] = strip_tags ( html_entity_decode($message['message']));
			$message['message'] = str_replace(array("&nbsp;"), ' ', $message['message']);
			
			$pdf->SetFont('Arial','B',10);
			$pdf->SetFillColor(200,220,255);
			$pdf->Cell(0,7, date('d/m/Y H:i:s', $message['creationDate']/1000).' - '.$message['userLogin'] ,1,1,'L',true);
			
			$pdf->SetFont('Arial','I',9);
			$pdf->MultiCell(0,6,$message['message'] ,1,1);
			$pdf->Ln(4);
		}
		$pdf->Output();
	}
	else {
		 header('Location: index.php?action=erreur&erreur=404');
	}
?>