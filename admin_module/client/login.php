<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password = md5($password);

		$sql = "SELECT * FROM tbl_clients WHERE email = '$email' AND password = '$password'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Unable to find your account. Please try again.';
			header('location: index.php');
		}
		else
		{
			$row = $query->fetch_assoc();
			$_SESSION['login_id'] = $row['id'];
			$_SESSION['email'] = $row['email'];

			echo "<script type='text/javascript'>";
			echo "alert('Login Successful!');";
			echo "window.location = '../../index.php';";
			echo "</script>";
		}
	}
	else{
		$_SESSION['error'] = 'Input credentials first!';
	}

	
?>