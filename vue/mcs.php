<?php
	if(!isset($_GET['mc'])) include('structures/mcs.php');
	else if(isset($_GET['mc'])) include('structures/mc.php');
?>