<?php
	if(!isset($_GET['mcc'])) include('structures/mccs.php');
	else if(isset($_GET['mcc'])) include('structures/mcc.php');
?>