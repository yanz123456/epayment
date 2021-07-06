<?php
    /*
    $user = "paymentsystem"; 
    $password = "pnu_2k20***"; 
    $host = "192.168.175.8"; 

    $connection= mysql_connect ($host, $user, $password);
    if (!$connection)
    {
    die ('Could not connect:' . mysql_error());
    }
    
    
    //show tables
    $showtables= mysql_query("SHOW TABLES FROM db_transactionportal");

    while($table = mysql_fetch_array($showtables)) { // go through each row that was returned in $result
        echo($table[0] . "<br>");    // print the table that was returned on that row.
    }
    */
    
    $user = "paymentsystem"; 
    $password = "pnu_2k20***"; 
    $host = "192.168.175.8"; 
    $database= "db_transactionportal";

    $connection= mysql_connect ($host, $user, $password);
    if (!$connection)
    {
    die ('Could not connect:' . mysql_error());
    }
    mysql_select_db($database, $connection);


    $truncatetable= mysql_query("DELETE * FROM tbl_requests");

    if($truncatetable !== FALSE)
    {
    echo("All rows have been deleted.");
    }
    else
    {
    echo("No rows have been deleted.");
    }
    
?>