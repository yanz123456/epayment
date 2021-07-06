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

$sql = "SHOW TABLES FROM db_transactionportal";
$result = mysql_query($sql);
if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) {
    echo "Table: {$row[0]}\n";
}
  
mysql_free_result($result);

?>