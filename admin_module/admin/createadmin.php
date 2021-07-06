<?php
	include 'includes/conn.php';

		$firstname = mysqli_real_escape_string($conn, $_POST['client_type']);;
        $lastname = mysqli_real_escape_string($conn, $_POST['client_type']);;
		
        $username = mysqli_real_escape_string($conn, $_POST['client_type']);;
        $confirm_password = mysqli_real_escape_string($conn, $_POST['client_type']);;

        $hashed = password_hash($confirm_password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO tbl_users (username, `password`, firstname, lastname, `type`) VALUES ('$username', '$hashed', '$firstname', '$lastname', 'office')";
        $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
        if($result)
        {
            $_SESSION['success'] = "success";
        }
        else
        {
            $_SESSION['error'] = $conn->error;
        }
?>