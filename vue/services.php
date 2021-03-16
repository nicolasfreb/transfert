<?php
	if(!isset($_GET['service'])&& isset($_GET['map'])) include('structures/map.php');
	else if(!isset($_GET['service'])) include('structures/services.php');
	else if(isset($_GET['service'])) include('structures/service.php');
?>