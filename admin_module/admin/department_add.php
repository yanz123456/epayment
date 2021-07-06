<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$title = strtoupper($title);

		$sql ="SELECT description FROM tbl_offices WHERE description = '$title' and remarks = 'active'";
		$result = $conn->query($sql);
		if($result->num_rows > 0)
        {
			$_SESSION['error'] = "Office already in the list!";
        }
		else
        {
            $sql = "INSERT INTO tbl_offices (description, remarks) VALUES ('$title', 'active')";
            if($conn->query($sql)){
				$firstname = mysqli_real_escape_string($conn, $_POST['title']);;
				$lastname = mysqli_real_escape_string($conn, $_POST['title']);;
				
				$username = mysqli_real_escape_string($conn, $_POST['title']);;
				$confirm_password = mysqli_real_escape_string($conn, $_POST['title']);;

				$hashed = md5($confirm_password);

				$sql = "SELECT MAX(id) as id FROM tbl_offices";
				$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
				$row = $result->fetch_assoc();
				$id = $row["id"];

				$sql = "INSERT INTO tbl_users (username, `password`, firstname, lastname, `type`, `office_id`) VALUES ('$username', '$hashed', '$firstname', '$lastname', 'office', '$id')";
				$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

                $_SESSION['success'] = 'Office added successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        }
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: offices.php');

?>