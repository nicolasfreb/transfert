<?php
	if(!isset($_GET['mcu'])) include('structures/mcus.php');
	else if(isset($_GET['mcu'])) include('structures/mcu.php');
?>