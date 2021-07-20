<?php
    $server = "192.168.175.15";
    $database = "pnuID";
    $username = "appointment";
    $password = "pnu_2k21***";

    $pwebss = mysqli_connect("192.168.175.15", "appointment", "pnu_2k21***", "pnuID");
    
    if (!$pwebss) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>