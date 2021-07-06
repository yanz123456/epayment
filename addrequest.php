<?php
	include 'admin_module/admin/includes/conn.php';

    $action = $_GET["action"];

    switch($action)
    {
        case 'add':
            $client_type = mysqli_real_escape_string($conn, $_POST['client_type']);
            

            if($client_type == "Student")
            {
                $account_code = mysqli_real_escape_string($conn, $_POST['transcode']);
                $studno = mysqli_real_escape_string($conn, $_POST['studno']);
                $lname = mysqli_real_escape_string($conn, $_POST['lname']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $note = mysqli_real_escape_string($conn, $_POST['note']);
                $year = mysqli_real_escape_string($conn, $_POST['year']);
                $month = mysqli_real_escape_string($conn, $_POST['month']);
                
                $count = 0;
                $sql = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM tbl_requests WHERE year = '$year'");
                while ($row = mysqli_fetch_array($sql)) 
                {
                    $count = $row['cnt'] + 1;
                }
                $count = str_pad($count, 6, 0, STR_PAD_LEFT);
                $transaction_id = $account_code.$year.$month."-".$count;

                $sql = "SELECT StudNo, LName, GName, MName FROM vStudInfo WHERE StudNo = '$studno' AND LName = '$lname' LIMIT 1";
                $result = mysqli_query($pwebss, $sql) or die(mysqli_error($pwebss));
                if($result->num_rows > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $GName = $row["GName"];
                        $MName = $row["MName"];
                    }
                    $sql = "SELECT transaction_id FROM tbl_requests WHERE requestor_id = '$studno' AND requestor_LName = '$lname' AND account_code = '$account_code' AND requestor_type = 'Student' AND remarks = 'Pending'";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    if($result->num_rows > 0)
                    {
                        $row = mysqli_fetch_assoc($result);
                        $transaction_id = $row["transaction_id"];
                        $string = "Pending transction with same account code currently found in your data! Please contact handling office to follow up or request for another type of transaction.\\n\\nTransaction Number: " . $transaction_id . "";
                        echo "<script type='text/javascript'>";
                        echo "alert(\"$string\");";
                        echo "window.location = ('index.php');";
                        echo "</script>";
                    }
                    else
                    {
                        $sql = "INSERT INTO tbl_requests (`transaction_id`, `requestor_type`, `requestor_id`, `requestor_LName`, `requestor_MName`, `requestor_GName`, `requestor_Email`, `account_code`, `year`, `note`, `remarks`) VALUES ('$transaction_id', '$client_type', '$studno', '$lname', '$MName', '$GName', '$email', '$account_code', '$year', '$note', 'Pending')";
                        if($conn->query($sql))
                        {
                            echo "<script type='text/javascript'>";
                            echo "alert('Request added successfully! You may now check your transaction details!');";
                            echo "window.location = ('index.php');";
                            echo "</script>";
                        }
                        else{
                            echo "<script type='text/javascript'>";
                            echo "alert('There is a problem adding the request!');";
                            echo "window.location = ('index.php');";
                            echo "</script>";
                        }
                    }
                }
                else
                {
                    echo "<script type='text/javascript'>";
                    echo "alert('Unable to verify student! Please re-check your details!');";
                    echo "window.location = ('index.php');";
                    echo "</script>";
                }
            }
            elseif($client_type == "Applicant")
            {
                $account_code = mysqli_real_escape_string($conn, $_POST['transcode']);
                $studno = mysqli_real_escape_string($conn, $_POST['applicantno']);
                $lname = mysqli_real_escape_string($conn, $_POST['lname']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $note = mysqli_real_escape_string($conn, $_POST['note']);
                $year = mysqli_real_escape_string($conn, $_POST['year']);
                $month = mysqli_real_escape_string($conn, $_POST['month']);
                
                $count = 0;
                $sql = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM tbl_requests WHERE year = '$year'");
                while ($row = mysqli_fetch_array($sql)) 
                {
                    $count = $row['cnt'] + 1;
                }
                $count = str_pad($count, 6, 0, STR_PAD_LEFT);
                $transaction_id = $account_code.$year.$month."-".$count;

                $sql = "SELECT StudNo, LName, GName, MName FROM vAppInfo WHERE StudNo = '$studno' AND LName = '$lname' LIMIT 1";
                $result = mysqli_query($pwebss, $sql) or die(mysqli_error($pwebss));
                if($result->num_rows > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $GName = $row["GName"];
                        $MName = $row["MName"];
                    }
                    $sql = "SELECT transaction_id FROM tbl_requests WHERE requestor_id = '$studno' AND requestor_LName = '$lname' AND account_code = '$account_code' AND requestor_type = 'Applicant' AND remarks = 'Pending'";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    if($result->num_rows > 0)
                    {
                        $row = mysqli_fetch_assoc($result);
                        $transaction_id = $row["transaction_id"];
                        $string = "Pending transction with same account code currently found in your data! Please contact handling office to follow up or request for another type of transaction.\\n\\nTransaction Number: " . $transaction_id . "";
                        echo "<script type='text/javascript'>";
                        echo "alert(\"$string\");";
                        echo "window.location = ('index.php');";
                        echo "</script>";
                    }
                    else
                    {
                        $sql = "INSERT INTO tbl_requests (`transaction_id`, `requestor_type`, `requestor_id`, `requestor_LName`, `requestor_MName`, `requestor_GName`, `requestor_Email`, `account_code`, `year`, `note`, `remarks`) VALUES ('$transaction_id', '$client_type', '$studno', '$lname', '$MName', '$GName', '$email', '$account_code', '$year', '$note', 'Pending')";
                        if($conn->query($sql))
                        {
                            echo "<script type='text/javascript'>";
                            echo "alert('Request added successfully! You may now check your transaction details!');";
                            echo "window.location = ('index.php');";
                            echo "</script>";
                        }
                        else{
                            echo "<script type='text/javascript'>";
                            echo "alert('There is a problem adding the request!');";
                            echo "window.location = ('index.php');";
                            echo "</script>";
                        }
                    }
                }
                else
                {
                    echo "<script type='text/javascript'>";
                    echo "alert('Unable to verify information! Please re-check your details!');";
                    echo "window.location = ('index.php');";
                    echo "</script>";
                }
            }
            elseif($client_type == "External1")
            {
                $account_code = mysqli_real_escape_string($conn, $_POST['transcode']);
                $studno = mysqli_real_escape_string($conn, $_POST['externalno']);
                $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
                $note = mysqli_real_escape_string($conn, $_POST['note']);
                $year = mysqli_real_escape_string($conn, $_POST['year']);
                $month = mysqli_real_escape_string($conn, $_POST['month']);
                
                $count = 0;
                $sql = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM tbl_requests WHERE year = '$year'");
                while ($row = mysqli_fetch_array($sql)) 
                {
                    $count = $row['cnt'] + 1;
                }
                $count = str_pad($count, 6, 0, STR_PAD_LEFT);
                $transaction_id = $account_code.$year.$month."-".$count;

                $sql = "SELECT ExternalNo, LName, GName, MName FROM tbl_externalview WHERE ExternalNo = '$studno' AND LName = '$lname' LIMIT 1";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if($result->num_rows > 0)
                {
                    $sql = "SELECT transaction_id FROM tbl_requests WHERE requestor_id = '$studno' AND requestor_LName = '$lname' AND account_code = '$account_code' AND requestor_type = 'External' AND remarks = 'Pending'";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    if($result->num_rows > 0)
                    {
                        $row = mysqli_fetch_assoc($result);
                        $transaction_id = $row["transaction_id"];
                        $string = "Pending transction with same account code currently found in your data! Please contact handling office to follow up or request for another type of transaction.\\n\\nTransaction Number: " . $transaction_id . "";
                        echo "<script type='text/javascript'>";
                        echo "alert(\"$string\");";
                        echo "window.location = ('index.php');";
                        echo "</script>";
                    }
                    else
                    {
                        $sql = "INSERT INTO tbl_requests (`transaction_id`, `requestor_type`, `requestor_id`, `requestor_LName`, `account_code`, `year`, `note`, `remarks`) VALUES ('$transaction_id', 'External', '$studno', '$lname', '$account_code', '$year', '$note', 'Pending')";
                        if($conn->query($sql))
                        {
                            echo "<script type='text/javascript'>";
                            echo "alert('Request added successfully! You may now check your transaction details!');";
                            echo "window.location = ('index.php');";
                            echo "</script>";
                        }
                        else{
                            echo "<script type='text/javascript'>";
                            echo "alert('There is a problem adding the request!');";
                            echo "window.location = ('index.php');";
                            echo "</script>";
                        }
                    }
                }
                else
                {
                    echo "<script type='text/javascript'>";
                    echo "alert('Unable to verify information! Please re-check your details!');";
                    echo "window.location = ('index.php');";
                    echo "</script>";
                }
            }
            else
            {
                $account_code = mysqli_real_escape_string($conn, $_POST['transcode']);
                $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
                $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
                $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $note = mysqli_real_escape_string($conn, $_POST['note']);
                $year = mysqli_real_escape_string($conn, $_POST['year']);
                $month = mysqli_real_escape_string($conn, $_POST['month']);
                
                $count = 0;
                $sql = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM tbl_requests WHERE year = '$year'");
                while ($row = mysqli_fetch_array($sql)) 
                {
                    $count = $row['cnt'] + 1;
                }
                $count = str_pad($count, 6, 0, STR_PAD_LEFT);
                $transaction_id = $account_code.$year.$month."-".$count;

                $datenow = date("Y-m-d h:i:s");
                $externalid = strtotime($datenow);

                $sql = "INSERT INTO tbl_externalview (`ExternalNo`, `LName`, `GName`, `MName`, `Email`) VALUES ('$externalid', '$lastname', '$firstname', '$middlename', '$email')";
                if($conn->query($sql))
                {
                    $sql = "INSERT INTO tbl_requests (`transaction_id`, `requestor_type`, `requestor_id`, `requestor_LName`, `account_code`, `year`, `note`, `remarks`) VALUES ('$transaction_id', 'External', '$externalid', '$lastname', '$account_code', '$year', '$note', 'Pending')";
                    if($conn->query($sql))
                    {
                        echo "<script type='text/javascript'>";
                        echo "alert('Request added successfully! You may now check your transaction details!');";
                        echo "window.location = ('index.php');";
                        echo "</script>";
                    }
                    else{
                        echo "<script type='text/javascript'>";
                        echo "alert('There is a problem adding the request!');";
                        echo "window.location = ('index.php');";
                        echo "</script>";
                    }
                }
                else
                {
                    echo "<script type='text/javascript'>";
                    echo "alert('There is an error saving your data! Please try again!');";
                    echo "window.location = ('index.php');";
                    echo "</script>";
                }
            }
        break;
    }
?>