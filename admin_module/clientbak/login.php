<?php
	session_start();
	include 'includes/conn.php';

    $action = $_GET["action"];

    switch($action)
    {
        case 'check':
            $client_type = mysqli_real_escape_string($conn, $_POST['cyt_client_type']);
            if($client_type == "Student")
            {
                $studno = mysqli_real_escape_string($conn, $_POST['studno']);
                $lname = mysqli_real_escape_string($conn, $_POST['lname']);

                $sql = "SELECT StudNo, LName, GName, MName FROM vStudInfo WHERE StudNo = '$studno' AND LName = '$lname' LIMIT 1";
                $result = mysqli_query($pwebss, $sql) or die(mysqli_error($pwebss));
                if($result->num_rows > 0)
                {
                    $_SESSION["logged_in"] = "YES";
                    $_SESSION['client'] = $studno;
                    $_SESSION['client_type'] = 'Student';

                    echo "<script type='text/javascript'>";
					echo "alert('Verification Successful!');";
					echo "window.location = ('index.php');";
					echo "</script>";
                }
                else
                {
                    echo "<script type='text/javascript'>";
                    echo "alert('Unable to verify student details! Please re-check your details!');";
                    echo "window.location = ('index.php');";
                    echo "</script>";
                }
            }
            elseif($client_type == "Applicant")
            {
                $studno = mysqli_real_escape_string($conn, $_POST['applicantno']);
                $lname = mysqli_real_escape_string($conn, $_POST['lname']);

                $sql = "SELECT AppNo, LName, GName, MName FROM tbl_appview WHERE AppNo = '$studno' AND LName = '$lname' LIMIT 1";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if($result->num_rows > 0)
                {
                    $_SESSION["logged_in"] = "YES";
                    $_SESSION['client'] = $studno;
                    $_SESSION['client_type'] = 'Applicant';

                    echo "<script type='text/javascript'>";
					echo "alert('Verification Successful!');";
					echo "window.location = ('index.php');";
					echo "</script>";
                }
                else
                {
                    echo "<script type='text/javascript'>";
                    echo "alert('Unable to verify applicant details! Please re-check your details!');";
                    echo "window.location = ('index.php');";
                    echo "</script>";
                }
            }
            else
            {
                $studno = mysqli_real_escape_string($conn, $_POST['externalno']);
                $lname = mysqli_real_escape_string($conn, $_POST['lastname']);

                $sql = "SELECT ExternalNo, LName, GName, MName FROM tbl_externalview WHERE ExternalNo = '$studno' AND LName = '$lname' LIMIT 1";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if($result->num_rows > 0)
                {
                    $_SESSION["logged_in"] = "YES";
                    $_SESSION['client'] = $studno;
                    $_SESSION['client_type'] = 'External';

                    echo "<script type='text/javascript'>";
					echo "alert('Verification Successful!');";
					echo "window.location = ('index.php');";
					echo "</script>";
                }
                else
                {
                    echo "<script type='text/javascript'>";
                    echo "alert('Unable to verify applicant details! Please re-check your details!');";
                    echo "window.location = ('index.php');";
                    echo "</script>";
                }
            }
        break;
    }
?>