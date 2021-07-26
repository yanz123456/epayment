<?php 
	include 'includes/conn.php';

	if(isset($_POST['appNo']) && isset($_POST['lastname'])){
		$appNo = $_POST['appNo'];
        $lastname = $_POST['lastname'];
        $sql = "SELECT StudNo, LName, GName, MName FROM vAppInfo WHERE LName = '$lastname' AND StudNo = '$appNo'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>