<?php
	session_start();
	include 'includes/conn.php';

	if(!isset($_SESSION['login_id']) || trim($_SESSION['login_id']) == ''){
		header('location: index.php');
	}

	$sql = "SELECT * FROM tbl_users WHERE id = '".$_SESSION['login_id']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();
?>