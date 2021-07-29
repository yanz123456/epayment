<?php 
	include 'admin_module/admin/includes/conn.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT a.*, b.description as office_name FROM tbl_transactions a LEFT JOIN tbl_offices b ON a.office_id = b.id WHERE a.account_code = '$id' AND a.remarks = 'active'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		$office_id = $row["office_id"];

		$loaded_transactions = array();
		$sql2 = "SELECT a.*, b.description as office_name FROM tbl_transactions a LEFT JOIN tbl_offices b ON a.office_id = b.id WHERE a.office_id = '$office_id' AND a.account_code <> '$id'  AND a.remarks = 'active'";
		$query2 = $conn->query($sql2);
		while($row2 = $query2->fetch_assoc())
		{
			$loaded_transactions[] = $row2;
		}

		$response = array(
			"transaction" => $row,
			"loadedTransaction" => $loaded_transactions
		);

		echo json_encode($response);
	}
?>