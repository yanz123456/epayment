<?php

include 'admin_module/admin/includes/conn.php';

$result = mysqli_query($conn, "SHOW FIELDS FROM $database.tbl_externalview");
while ($row = mysqli_fetch_array($result)) {
  echo $row['Field'] . ' - ' . $row['Type'].'<br>';
}

echo "<br>";

$result2 = mysqli_query($conn, "SHOW FIELDS FROM $database.tbl_offices");
while ($row2 = mysqli_fetch_array($result2)) {
  echo $row2['Field'] . ' - ' . $row2['Type'].'<br>';
}

echo "<br>";

$result3 = mysqli_query($conn, "SHOW FIELDS FROM $database.tbl_requests");
while ($row3 = mysqli_fetch_array($result3)) {
  echo $row3['Field'] . ' - ' . $row3['Type'].'<br>';
}

echo "<br>";

$result4 = mysqli_query($conn, "SHOW FIELDS FROM $database.tbl_transactions");
while ($row4 = mysqli_fetch_array($result4)) {
  echo $row4['Field'] . ' - ' . $row4['Type'].'<br>';
}

echo "<br>";

$result5 = mysqli_query($conn, "SHOW FIELDS FROM $database.tbl_users");
while ($row5 = mysqli_fetch_array($result5)) {
  echo $row5['Field'] . ' - ' . $row5['Type'].'<br>';
}

echo "<br>";

?>