<?php
	if(!isset($_GET['salon'])) include('structures/salons.php');
	else if(isset($_GET['salon'])) include('structures/salon.php');
?>