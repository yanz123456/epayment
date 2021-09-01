<?php
	include 'includes/session.php';

    $action = $_GET["action"];

    switch($action)
    {
        case 'confirm':
            $transaction_id = $_POST["transaction_id"];
            $total_amount = $_POST["total_amount"];
            $request_transactions_id = $_POST["request_transactions_id"];
            $datenow = date("Y-m-d H:i:s");
            $ta = array_sum($total_amount);
            $sql ="UPDATE tbl_requests SET remarks = 'Accepted', amount_to_pay = '$ta', accepted_date = '$datenow' WHERE transaction_id = '$transaction_id'";
            if($conn->query($sql))
            {
                $request_transactions_id = $_POST["request_transactions_id"];
                $qty_of_inputs = $_POST["qty_of_inputs"];

                for($i = 0; $i < count($request_transactions_id); $i++)
                {
                    $sql ="UPDATE tbl_request_transactions SET quantity_of_unit = '$qty_of_inputs[$i]', amount = '$total_amount[$i]' WHERE transaction_id = '$transaction_id' AND request_transactions_id = '$request_transactions_id[$i]'";
                    $conn->query($sql);
                }

                $_SESSION['success'] = 'Request updated successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        break;
        case 'decline':
            $transaction_id = mysqli_real_escape_string($conn, $_POST['del_transaction_number']);
            $reason = mysqli_real_escape_string($conn, $_POST['reason']);
            $sql ="UPDATE tbl_requests SET remarks = 'Declined', reason_of_decline = '$reason' WHERE transaction_id = '$transaction_id'";
            if($conn->query($sql))
            {
                $_SESSION['success'] = 'Request updated successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        break;
    }
    echo "<script>window.location.href='office_module.php';</script>";
?>