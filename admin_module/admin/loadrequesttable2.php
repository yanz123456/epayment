<?php
    session_start();
    include 'includes/conn.php';
    $office_id = $_SESSION['office_id'];
    $client_type = $_GET["client_type"];

    switch($client_type)
    {
        case 'Student':
            $sql = "SELECT a.*, b.description, a.remarks AS transaction_remarks, CONCAT(a.requestor_LName, ', ', a.requestor_GName, ' ', a.requestor_MName) as full_name, a.requestor_Email FROM tbl_requests a LEFT JOIN tbl_transactions b ON a.`account_code` = b.account_code LEFT JOIN tbl_offices c ON b.office_id = c.id WHERE b.office_id = '$office_id' AND a.remarks = 'Accepted' AND a.requestor_type = 'Student' ORDER BY a.accepted_date DESC";
            $query = $conn->query($sql);
            while($row = $query->fetch_assoc())
            {
                $transaction_id = $row['transaction_id'];
                $requestor_type = $row['requestor_type'];
                $requestor_id = $row['requestor_id'];
                $full_name = $row['full_name'];
                $email = $row['requestor_Email'];
                $note = $row['note'];
                $transaction_date = $row['transaction_date'];
                $accepted_date = $row['accepted_date'];
                $account_code = $row['account_code'];
                $description = $row['description'];
                $amount = $row['amount_to_pay'];
                $quantity = $row['quantity_of_unit'];
                $remarks = $row['transaction_remarks'];
                $transaction_date = date('M d, Y h:i:s A', strtotime($row['transaction_date']));
                $accepted_date = date('M d, Y h:i:s A', strtotime($row['accepted_date']));
                
                echo "
                    <tr id='tr$transaction_id'>
                    <td>$requestor_type</td>
                    <td>$transaction_id</td>
                    <td>$requestor_id</td>
                    <td>$full_name</td>
                    <td>$email</td>
                    <td>$account_code</td>
                    <td>$description</td>
                    <td align='right'>P ".number_format($amount,2)."</td>
                    <td align='right'>$quantity</td>
                    <td>$note</td>
                    <td>$remarks</td>
                    <td>$transaction_date</td>
                    <td>$accepted_date</td>
                    </tr>
                ";
            }
        break;
        case 'Applicant':
            $sql = "SELECT a.*, b.description, a.remarks AS transaction_remarks, CONCAT(a.requestor_LName, ', ', a.requestor_GName, ' ', a.requestor_MName) as full_name, a.requestor_Email FROM tbl_requests a LEFT JOIN tbl_transactions b ON a.`account_code` = b.account_code LEFT JOIN tbl_offices c ON b.office_id = c.id WHERE b.office_id = '$office_id' AND a.remarks = 'Accepted' AND a.requestor_type = 'Applicant' ORDER BY a.accepted_date DESC";
            $query = $conn->query($sql);
            while($row = $query->fetch_assoc())
            {
                $transaction_id = $row['transaction_id'];
                $requestor_type = $row['requestor_type'];
                $requestor_id = $row['requestor_id'];
                $full_name = $row['full_name'];
                $email = $row['requestor_Email'];
                $note = $row['note'];
                $transaction_date = $row['transaction_date'];
                $accepted_date = $row['accepted_date'];
                $account_code = $row['account_code'];
                $description = $row['description'];
                $amount = $row['amount_to_pay'];
                $quantity = $row['quantity_of_unit'];
                $remarks = $row['transaction_remarks'];
                $transaction_date = date('M d, Y h:i:s A', strtotime($row['transaction_date']));
                $accepted_date = date('M d, Y h:i:s A', strtotime($row['accepted_date']));
                
                echo "
                    <tr id='tr$transaction_id'>
                    <td>$requestor_type</td>
                    <td>$transaction_id</td>
                    <td>$requestor_id</td>
                    <td>$full_name</td>
                    <td>$email</td>
                    <td>$account_code</td>
                    <td>$description</td>
                    <td align='right'>P ".number_format($amount,2)."</td>
                    <td align='right'>$quantity</td>
                    <td>$note</td>
                    <td>$remarks</td>
                    <td>$transaction_date</td>
                    <td>$accepted_date</td>
                    </tr>
                ";
            }
        break;
        case 'External':
            $sql = "SELECT a.*, b.description, a.remarks AS transaction_remarks, CONCAT(d.LName, ', ', d.GName, ' ', d.MName) as full_name, d.Email FROM tbl_requests a LEFT JOIN tbl_transactions b ON a.`account_code` = b.account_code LEFT JOIN tbl_offices c ON b.office_id = c.id LEFT JOIN tbl_externalview d ON a.requestor_id = d.ExternalNo WHERE b.office_id = '$office_id' AND a.remarks = 'Accepted' AND a.requestor_type = 'External' ORDER BY a.accepted_date DESC";
            $query = $conn->query($sql);
            while($row = $query->fetch_assoc())
            {
                $transaction_id = $row['transaction_id'];
                $requestor_type = $row['requestor_type'];
                $requestor_id = $row['requestor_id'];
                $full_name = $row['full_name'];
                $email = $row['Email'];
                $note = $row['note'];
                $transaction_date = $row['transaction_date'];
                $accepted_date = $row['accepted_date'];
                $account_code = $row['account_code'];
                $description = $row['description'];
                $amount = $row['amount_to_pay'];
                $quantity = $row['quantity_of_unit'];
                $remarks = $row['transaction_remarks'];
                $transaction_date = date('M d, Y h:i:s A', strtotime($row['transaction_date']));
                $accepted_date = date('M d, Y h:i:s A', strtotime($row['accepted_date']));
                
                echo "
                    <tr id='tr$transaction_id'>
                    <td>$requestor_type</td>
                    <td>$transaction_id</td>
                    <td>$requestor_id</td>
                    <td>$full_name</td>
                    <td>$email</td>
                    <td>$account_code</td>
                    <td>$description</td>
                    <td align='right'>P ".number_format($amount,2)."</td>
                    <td align='right'>$quantity</td>
                    <td>$note</td>
                    <td>$remarks</td>
                    <td>$transaction_date</td>
                    <td>$accepted_date</td>
                    </tr>
                ";
            }
        break;
    }
    
?>

