<?php
	session_start();
	include 'conn.php';

	if(!isset($_SESSION['login_id']) || trim($_SESSION['login_id']) == ''){
		header('location: admin_module/client/index.php');
	}

	$sql = "SELECT * FROM tbl_clients WHERE id = '".$_SESSION['login_id']."'";
	$query = $conn->query($sql);
	$client = $query->fetch_assoc();
?>