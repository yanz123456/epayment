<?php
	include 'includes/session.php';

    $action = $_GET["action"];

    switch($action)
    {
        case 'confirm':
            $transaction_type = mysqli_real_escape_string($conn, $_POST['type_of_transaction']);
            $transaction_number = mysqli_real_escape_string($conn, $_POST['transaction_number']);
            $datenow = date("Y-m-d H:i:s");

            if ($transaction_type == "Fixed")
            {
                $amount = mysqli_real_escape_string($conn, $_POST['amount_to_post']);
                $sql ="UPDATE tbl_requests SET amount_to_pay = '$amount', accepted_date = '$datenow', remarks = 'Accepted' WHERE transaction_id = '$transaction_number'";
            }
            elseif($transaction_type == "Fixed With Unit")
            {
                $amount = $_POST["total_amount"];
                $quantity = $_POST["quantity"];
                $sql ="UPDATE tbl_requests SET amount_to_pay = '$amount', quantity_of_unit = '$quantity', accepted_date = '$datenow', remarks = 'Accepted' WHERE transaction_id = '$transaction_number'";
            }
            else
            {
                $amount = $_POST["amount"];
                $sql ="UPDATE tbl_requests SET amount_to_pay = '$amount', accepted_date = '$datenow', remarks = 'Accepted' WHERE transaction_id = '$transaction_number'";
            }

            if($conn->query($sql))
            {
                $_SESSION['success'] = 'Request updated successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        break;
        case 'decline':
            $transaction_number = mysqli_real_escape_string($conn, $_POST['del_transaction_number']);
            $reason = mysqli_real_escape_string($conn, $_POST['reason']);
            $sql ="UPDATE tbl_requests SET remarks = 'Declined', reason_of_decline = '$reason' WHERE transaction_id = '$transaction_number'";
            if($conn->query($sql))
            {
                $_SESSION['success'] = 'Request updated successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        break;
    }
	header('location: office_module.php');

?>