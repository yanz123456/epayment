<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password = md5($password);

		$sql = "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Unable to find your account. Please try again.';
			header('location: index.php');
		}
		else
		{
			$row = $query->fetch_assoc();
			$_SESSION['login_id'] = $row['id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION["admintype"] = $row["type"];

			if($_SESSION["admintype"] == "office")
			{
				$sql = "SELECT id as office_id FROM tbl_offices WHERE description = '". $_SESSION['username'] ."'";
				$query = $conn->query($sql);
				$row = $query->fetch_assoc();
				$_SESSION["office_id"] = $row["office_id"];
			}

			echo "<script type='text/javascript'>";
			echo "alert('Login Successful!');";
			echo "window.location = 'index.php';";
			echo "</script>";
		}
	}
	else{
		$_SESSION['error'] = 'Input admin credentials first';
	}

	
?>