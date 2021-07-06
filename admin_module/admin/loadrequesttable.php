<?php
    session_start();
    include 'includes/conn.php';
    $office_id = $_SESSION['office_id'];
    $client_type = $_GET["client_type"];

    switch($client_type)
    {
        case 'Student':
            $sql = "SELECT a.*, b.description, IFNULL(b.amount, 0.00) as amount, a.remarks AS transaction_remarks, CONCAT(a.requestor_LName, ', ', a.requestor_GName, ' ', a.requestor_MName) as full_name, a.requestor_Email FROM tbl_requests a LEFT JOIN tbl_transactions b ON a.`account_code` = b.account_code LEFT JOIN tbl_offices c ON b.office_id = c.id WHERE b.office_id = '$office_id' AND a.remarks = 'Pending' AND a.requestor_type = '$client_type' ORDER BY a.transaction_date ASC";
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
                $account_code = $row['account_code'];
                $description = $row['description'];
                $amount = $row['amount'];
                $remarks = $row['transaction_remarks'];
                $transaction_date = date('M d, Y h:i:s A', strtotime($row['transaction_date']));
                
                echo "
                    <tr id='tr$transaction_id'>
                    <td>$requestor_type</td>
                    <td>$transaction_id</td>
                    <td>$requestor_id</td>
                    <td>$full_name</td>
                    <td>$email</td>
                    <td>$account_code</td>
                    <td>$description</td>
                    <td align='right'>P $amount</td>
                    <td>$note</td>
                    <td>$remarks</td>
                    <td>$transaction_date</td>
                    <td>
                        <button class='col-xs-12 btn btn-success btn-sm process btn-flat' data-transaction_id='$transaction_id'><i class='fa fa-check'></i> Confirm</button>
                        <button class='col-xs-12 btn btn-danger btn-sm decline btn-flat' data-transaction_id='$transaction_id'><i class='fa fa-trash'></i> Decline</button>
                    </td>
                    </tr>
                ";
            }
        break;
        case 'Applicant':
            $sql = "SELECT a.*, b.description, IFNULL(b.amount, 0.00) as amount, a.remarks AS transaction_remarks, CONCAT(a.requestor_LName, ', ', a.requestor_GName, ' ', a.requestor_MName) as full_name, a.requestor_Email FROM tbl_requests a LEFT JOIN tbl_transactions b ON a.`account_code` = b.account_code LEFT JOIN tbl_offices c ON b.office_id = c.id WHERE b.office_id = '$office_id' AND a.remarks = 'Pending' AND a.requestor_type = '$client_type' ORDER BY a.transaction_date ASC";
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
                $account_code = $row['account_code'];
                $description = $row['description'];
                $amount = $row['amount'];
                $remarks = $row['transaction_remarks'];
                $transaction_date = date('M d, Y h:i:s A', strtotime($row['transaction_date']));
                
                echo "
                    <tr id='tr$transaction_id'>
                    <td>$requestor_type</td>
                    <td>$transaction_id</td>
                    <td>$requestor_id</td>
                    <td>$full_name</td>
                    <td>$email</td>
                    <td>$account_code</td>
                    <td>$description</td>
                    <td align='right'>P $amount</td>
                    <td>$note</td>
                    <td>$remarks</td>
                    <td>$transaction_date</td>
                    <td>
                        <button class='col-xs-12 btn btn-success btn-sm process btn-flat' data-transaction_id='$transaction_id'><i class='fa fa-check'></i> Confirm</button>
                        <button class='col-xs-12 btn btn-danger btn-sm decline btn-flat' data-transaction_id='$transaction_id'><i class='fa fa-trash'></i> Decline</button>
                    </td>
                    </tr>
                ";
            }
        break;
        case 'External':
            $sql = "SELECT a.*, b.description, b.amount, a.remarks AS transaction_remarks, CONCAT(d.LName, ', ', d.GName, ' ', d.MName) as full_name, d.Email FROM tbl_requests a LEFT JOIN tbl_transactions b ON a.`account_code` = b.account_code LEFT JOIN tbl_offices c ON b.office_id = c.id LEFT JOIN tbl_externalview d ON a.requestor_id = d.ExternalNo WHERE b.office_id = '$office_id' AND a.remarks = 'Pending' AND a.requestor_type = '$client_type' ORDER BY a.transaction_date ASC";
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
                $account_code = $row['account_code'];
                $description = $row['description'];
                $amount = $row['amount'];
                $remarks = $row['transaction_remarks'];
                $transaction_date = date('M d, Y h:i:s A', strtotime($row['transaction_date']));
                
                echo "
                    <tr id='tr$transaction_id'>
                    <td>$requestor_type</td>
                    <td>$transaction_id</td>
                    <td>$requestor_id</td>
                    <td>$full_name</td>
                    <td>$email</td>
                    <td>$account_code</td>
                    <td>$description</td>
                    <td align='right'>P $amount</td>
                    <td>$note</td>
                    <td>$remarks</td>
                    <td>$transaction_date</td>
                    <td>
                        <button class='col-xs-12 btn btn-success btn-sm process btn-flat' data-transaction_id='$transaction_id'><i class='fa fa-check'></i> Confirm</button>
                        <button class='col-xs-12 btn btn-danger btn-sm decline btn-flat' data-transaction_id='$transaction_id'><i class='fa fa-trash'></i> Decline</button>
                    </td>
                    </tr>
                ";
            }
        break;
    }
    
?>

