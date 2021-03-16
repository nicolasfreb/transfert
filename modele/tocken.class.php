<?php
	class Tocken{
		private $tocken;
		
		function generateTocken(){
			$this->tocken = hash('sha256', "Le cricri de la crique cris son cri cru et critique car il crain que l'escro ne le craque, ne le croque".$_SESSION['user']['userLogin'].$_SESSION['user']['userPassword']);
		}
		
		function getTocken(){
			return $this->tocken;
		}
	}	
?>