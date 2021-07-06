<?php

include 'admin_module/admin/includes/conn.php';

if($result = $conn->query('SHOW TABLES')){
    while($row = $conn->fetch_array($result)){
      $tables[] = $row[0];
    }
  }
  
  print_r($tables);

?>