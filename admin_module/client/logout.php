<?php
	session_start();
	$_SESSION["client"] = "";

	header('location: ../../index.php');
?>