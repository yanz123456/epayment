<?php
    session_start();
    include 'includes/conn.php';
    $office_id = $_SESSION['office_id'];
    $client_type = $_GET["client_type"];

    switch($client_type)
    {
        case 'Student':
            $sql = "SELECT a.*, b.* FROM tbl_requests a LEFT JOIN tbl_clients b ON a.`requestor_id` = b.`id` WHERE a.`transaction_office_id` = '$office_id' AND a.`remarks` = 'Accepted' AND b.`client_type` = 'Student' ORDER BY a.`transaction_date` ASC";
            $query = $conn->query($sql);
            while($row = $query->fetch_assoc())
            {
                $client_type = $row['client_type'];
                $transaction_id = $row['transaction_id'];
                if($row['client_type'] == "Student")
                {
                $requestor_id = $row['student_number'];
                }
                elseif($row['client_type'] == "Applicant")
                {
                $requestor_id = $row['applicant_number'];
                }
                else
                {
                $requestor_id = "--";
                }
                $full_name = $row['lastname'].", ".$row["firstname"]." ".$row["middlename"];
                $email = $row['email'];
                $remarks = $row['remarks'];
                $transaction_date = date('M d, Y h:i:s A', strtotime($row['transaction_date']));
                
                echo "
                <tr id='tr$transaction_id'>
                    <td>$client_type</td>
                    <td>$transaction_id</td>
                    <td>$requestor_id</td>
                    <td>$full_name</td>
                    <td>$email</td>
                    <td>$remarks</td>
                    <td>$transaction_date</td>
                </tr>
                ";
            }
        break;
        case 'Applicant':
            $sql = "SELECT a.*, b.* FROM tbl_requests a LEFT JOIN tbl_clients b ON a.`requestor_id` = b.`id` WHERE a.`transaction_office_id` = '$office_id' AND a.`remarks` = 'Accepted' AND b.`client_type` = 'Applicant' ORDER BY a.`transaction_date` ASC";
            $query = $conn->query($sql);
            while($row = $query->fetch_assoc())
            {
                $client_type = $row['client_type'];
                $transaction_id = $row['transaction_id'];
                if($row['client_type'] == "Student")
                {
                $requestor_id = $row['student_number'];
                }
                elseif($row['client_type'] == "Applicant")
                {
                $requestor_id = $row['applicant_number'];
                }
                else
                {
                $requestor_id = "--";
                }
                $full_name = $row['lastname'].", ".$row["firstname"]." ".$row["middlename"];
                $email = $row['email'];
                $remarks = $row['remarks'];
                $transaction_date = date('M d, Y h:i:s A', strtotime($row['transaction_date']));
                
                echo "
                <tr id='tr$transaction_id'>
                    <td>$client_type</td>
                    <td>$transaction_id</td>
                    <td>$requestor_id</td>
                    <td>$full_name</td>
                    <td>$email</td>
                    <td>$remarks</td>
                    <td>$transaction_date</td>
                </tr>
                ";
            }
        break;
        case 'External':
            $sql = "SELECT a.*, b.* FROM tbl_requests a LEFT JOIN tbl_clients b ON a.`requestor_id` = b.`id` WHERE a.`transaction_office_id` = '$office_id' AND a.`remarks` = 'Accepted' AND b.`client_type` = 'External' ORDER BY a.`transaction_date` ASC";
            $query = $conn->query($sql);
            while($row = $query->fetch_assoc())
            {
                $client_type = $row['client_type'];
                $transaction_id = $row['transaction_id'];
                if($row['client_type'] == "Student")
                {
                $requestor_id = $row['student_number'];
                }
                elseif($row['client_type'] == "Applicant")
                {
                $requestor_id = $row['applicant_number'];
                }
                else
                {
                $requestor_id = "--";
                }
                $full_name = $row['lastname'].", ".$row["firstname"]." ".$row["middlename"];
                $email = $row['email'];
                $remarks = $row['remarks'];
                $transaction_date = date('M d, Y h:i:s A', strtotime($row['transaction_date']));
                
                echo "
                <tr id='tr$transaction_id'>
                    <td>$client_type</td>
                    <td>$transaction_id</td>
                    <td>$requestor_id</td>
                    <td>$full_name</td>
                    <td>$email</td>
                    <td>$remarks</td>
                    <td>$transaction_date</td>
                </tr>
                ";
            }
        break;
    }
    
?>

