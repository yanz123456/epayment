<?php 
	include 'admin_module/admin/includes/conn.php';

	if(isset($_POST['office_id'])){
		$office_id = $_POST['office_id'];

		$sql = "SELECT a.*, b.description as office_name FROM tbl_transactions a LEFT JOIN tbl_offices b ON a.office_id = b.id WHERE a.office_id = '$office_id' AND a.remarks = 'active'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

        $i = 0;
        foreach($row as $row2)
        {
            $arr[$i] = $row2;
            $i++;
        }

        echo json_encode($arr);
	}
?>