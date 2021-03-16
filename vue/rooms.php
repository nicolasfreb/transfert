<?php
	if(!isset($_GET['room'])) include('structures/rooms.php');
	else if(isset($_GET['room'])) include('structures/room.php');
?>