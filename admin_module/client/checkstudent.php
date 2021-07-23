<?php 
	include 'includes/conn.php';

	if(isset($_POST['studNo']) && isset($_POST['lastname']) && isset($_POST['email'])){
		$studNo = $_POST['studNo'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        if($email == "Use PNU Email instead")
        {
            $sql = "SELECT * FROM vStudInfo WHERE LName = '$lastname' AND StudNo = '$studNo'";
        }
        else
        {
            $sql = "SELECT StudNo, LName, GName, MName FROM vStudInfo WHERE LName = '$lastname' AND StudNo = '$studNo'";
        }
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>