<?php
	$timezone = 'Asia/Manila';
	date_default_timezone_set($timezone);

	$server = "localhost";
    $database = "db_transactionportal";
    $username = "root";
    $password = "";

	$conn = new mysqli($server, $username, $password, $database);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$server1 = "localhost";
    $database1 = "db_transactionportal";
    $username1 = "root";
    $password1 = "";

	$pwebss = new mysqli($server1, $username1, $password1, $database1);
	if ($pwebss->connect_error) {
	    die("Connection failed: " . $pwebss->connect_error);
	}
?>