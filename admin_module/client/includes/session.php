<?php
	session_start();
	include 'includes/conn.php';

	if(!isset($_SESSION['client']) || trim($_SESSION['client']) == '')
	{
		header('location: ../../index.php');
	}

	$sql = "SELECT * FROM vStudInfo WHERE StudNo = '".$_SESSION['client']."'";
    $result = mysqli_query($pwebss, $sql) or die(mysqli_error($pwebss));
	$user = mysqli_fetch_assoc($result);
?>