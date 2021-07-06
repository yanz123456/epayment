<?php

include 'admin_module/admin/includes/conn.php';

$result = mysqli_query($conn,"show tables"); // run the query and assign the result to $result
while($table = mysqli_fetch_array($result)) { // go through each row that was returned in $result
    echo($table[0] . "<BR>");    // print the table that was returned on that row.
}

?>