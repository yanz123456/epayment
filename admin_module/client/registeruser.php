<?php 
	include 'includes/conn.php';

    $client_type = mysqli_real_escape_string($conn, $_POST['client_type']);
    $student_number = mysqli_real_escape_string($conn, $_POST['student_number']);
    $applicant_number = mysqli_real_escape_string($conn, $_POST['applicant_number']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $maiden_name = mysqli_real_escape_string($conn, $_POST['maiden_name']);
    $sex = mysqli_real_escape_string($conn, $_POST['sex']);
    $civil_status = mysqli_real_escape_string($conn, $_POST['civil_status']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $city_address = mysqli_real_escape_string($conn, $_POST['city_address']);
    $permanent_address = mysqli_real_escape_string($conn, $_POST['permanent_address']);

    $hashed = md5($password);

    if($client_type == "Student")
    {
        $sql = "SELECT * FROM tbl_clients WHERE student_number = '$student_number' LIMIT 1";
    }
    elseif($client_type == "Applicant")
    {
        $sql = "SELECT * FROM tbl_clients WHERE applicant_number = '$applicant_number' LIMIT 1";
    }
    else
    {
        $sql = "SELECT * FROM tbl_clients WHERE email = '$email' LIMIT 1";
    }
    $result = mysqli_query($conn, $sql);
    $row = $result->num_rows;

    if($row > 0)
    {
        echo json_encode(array("statusCode"=>"User has an existing account! Please reset your password if forgotten or contact PNU!"));
    }
    else
    {
        $sql = "INSERT INTO tbl_clients (email, password, client_type, student_number, applicant_number, lastname, firstname, middlename, dob, maiden_name, sex, civil_status, contact_number, city_address, permanent_address) VALUES ('$email', '$hashed', '$client_type', '$student_number', '$applicant_number', '$lastname', '$firstname', '$middlename', '$dob', '$maiden_name', '$sex', '$civil_status', '$contact', '$city_address', '$permanent_address')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo json_encode(array("statusCode"=>201));
        }
    }
	mysqli_close($conn);
?>