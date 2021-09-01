<?php 
	include 'admin_module/admin/includes/conn.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT a.*, b.description as office_name FROM tbl_transactions a LEFT JOIN tbl_offices b ON a.office_id = b.id WHERE a.account_code = '$id' AND a.remarks = 'active'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		$response = array(
			"transaction" => $row
		);

		echo json_encode($response);
	}
?>