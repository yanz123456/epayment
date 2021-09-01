<?php 
	include '../admin_module/admin/includes/conn.php';

    $trans_user_id = mysqli_real_escape_string($conn, $_POST['trans_user_id']);
    $confirmation_account_code = $_POST['confirmation_account_code'];
    $confirmation_quantity_of_unit = $_POST['confirmation_quantity_of_unit'];
    $confirmation_no_of_copies = $_POST['confirmation_no_of_copies'];
    $year = $_POST['year'];
    $month = $_POST['month'];

    $count = 0;
    $sql = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM tbl_requests WHERE year = '$year'");
    while ($row = mysqli_fetch_array($sql)) 
    {
        $count = $row['cnt'] + 1;
    }
    $count = str_pad($count, 6, 0, STR_PAD_LEFT);
    $transaction_id = $year.$month."-".$count;

    $sql2 = "SELECT office_id FROM tbl_transactions WHERE account_code = '$confirmation_account_code[0]'";
    $query2 = $conn->query($sql2);
    while($row = $query2->fetch_assoc())
    {
        $office_id = $row["office_id"];
    }

    $sql3 = "SELECT * FROM tbl_requests WHERE requestor_id = '$trans_user_id' AND transaction_office_id = '$office_id' AND remarks = 'Pending' LIMIT 1";
    $query3 = $conn->query($sql3);
    if(mysqli_num_rows($query3) > 0)
    {
        echo "<script type='text/javascript'>";
        echo "alert('You already have pending transaction on this office. Please wait for them to check it first!');";
        echo "window.location = ('../index.php');";
        echo "</script>";
    }
    else
    {
        //echo $office_id;
        $sql = "INSERT INTO tbl_requests (`transaction_id`, `requestor_id`, `year`, `remarks`, `transaction_office_id`) VALUES ('$transaction_id', '$trans_user_id', '$year', 'Pending', '$office_id')";
        if($conn->query($sql))
        {
            echo count($_POST['confirmation_account_code']);
            for ($i = 0; $i < count($_POST['confirmation_account_code']); $i++)
            {
                $sql2 = "INSERT INTO tbl_request_transactions (`transaction_id`, `account_code`, `quantity_of_unit`, `no_of_copies`) VALUES ('$transaction_id', '$confirmation_account_code[$i]', '$confirmation_quantity_of_unit[$i]', '$confirmation_no_of_copies[$i]')";
                $conn->query($sql2);
            }
            
            echo "<script type='text/javascript'>";
            echo "alert('Transaction request submitted successfully!');";
            echo "window.location = ('../index.php');";
            echo "</script>";
        }
        else{
            echo "<script type='text/javascript'>";
            echo "alert('There is a problem adding the request!');";
            echo "window.location = ('../index.php');";
            echo "</script>";
        }
    }
    
    

?>