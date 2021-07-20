<?php
	$timezone = 'Asia/Manila';
	date_default_timezone_set($timezone);

	$server = "192.168.175.8";
    $database = "db_transactionportal";
    $username = "paymentsystem";
    $password = "pnu_2k20***";

	$conn = new mysqli($server, $username, $password, $database);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$server1 = "192.168.175.15";
    $database1 = "pnuID";
    $username1 = "appointment";
    $password1 = "pnu_2k21***";

	$pwebss = new mysqli($server1, $username1, $password1, $database1);
	if ($pwebss->connect_error) {
	    die("Connection failed: " . $pwebss->connect_error);
	}
?>