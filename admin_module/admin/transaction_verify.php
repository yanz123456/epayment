<?php
	include 'includes/session.php';

    $action = $_GET["action"];

    switch($action)
    {
        case 'add':
            switch($_POST["trans_type"])
            {
                case 'Fixed':
                    $account_code = mysqli_real_escape_string($conn, $_POST['account_code']);
                    $trans_category = mysqli_real_escape_string($conn, $_POST['trans_category']);
                    $description = mysqli_real_escape_string($conn, $_POST['description']);
                    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
                    $office = mysqli_real_escape_string($conn, $_POST['office']);
        
                    $sql ="SELECT account_code FROM tbl_transactions WHERE account_code = '$account_code' and remarks = 'active'";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0)
                    {
                        $_SESSION['error'] = "Transaction Code already in the list!";
                    }
                    else
                    {
                        if($trans_category == "Document")
                        {
                            $trans_no_of_copy = mysqli_real_escape_string($conn, $_POST['trans_no_of_copy']);
                            $sql = "INSERT INTO tbl_transactions (account_code, description, amount, transaction_type, category, unit_inputted_by, no_of_copy, office_id, remarks) VALUES ('$account_code', '$description', '$amount', 'Fixed', '$trans_category', 'Office', '$trans_no_of_copy', '$office', 'active')";
                        }
                        else
                        {
                            $sql = "INSERT INTO tbl_transactions (account_code, description, amount, transaction_type, category, unit_inputted_by, no_of_copy, office_id, remarks) VALUES ('$account_code', '$description', '$amount', 'Fixed', '$trans_category', 'Office', 'NO', '$office', 'active')";
                        }
                        
                        if($conn->query($sql)){
                            $_SESSION['success'] = 'Transaction added successfully';
                        }
                        else{
                            $_SESSION['error'] = $conn->error;
                        }
                    }
                break;
                case 'Fixed With Unit':
                    $account_code = mysqli_real_escape_string($conn, $_POST['account_code']);
                    $trans_category = mysqli_real_escape_string($conn, $_POST['trans_category']);
                    $description = mysqli_real_escape_string($conn, $_POST['description']);
                    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
                    $unit = mysqli_real_escape_string($conn, $_POST['unit']);
                    $office = mysqli_real_escape_string($conn, $_POST['office']);
                    $trans_unit_inputtedby = mysqli_real_escape_string($conn, $_POST['trans_unit_inputtedby']);
        
                    $sql ="SELECT account_code FROM tbl_transactions WHERE account_code = '$account_code' and remarks = 'active'";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0)
                    {
                        $_SESSION['error'] = "Transaction Code already in the list!";
                    }
                    else
                    {
                        if($trans_category == "Document")
                        {
                            $trans_no_of_copy = mysqli_real_escape_string($conn, $_POST['trans_no_of_copy']);
                            $sql = "INSERT INTO tbl_transactions (account_code, description, amount, unit, transaction_type, category, unit_inputted_by, no_of_copy, office_id, remarks) VALUES ('$account_code', '$description', '$amount', '$unit', 'Fixed With Unit', '$trans_category', '$trans_unit_inputtedby', '$trans_no_of_copy', '$office', 'active')";
                        }
                        else
                        {
                            $sql = "INSERT INTO tbl_transactions (account_code, description, amount, unit, transaction_type, category, unit_inputted_by, no_of_copy, office_id, remarks) VALUES ('$account_code', '$description', '$amount', '$unit', 'Fixed With Unit', '$trans_category', '$trans_unit_inputtedby', 'NO', '$office', 'active')";
                        }

                        if($conn->query($sql)){
                            $_SESSION['success'] = 'Transaction added successfully';
                        }
                        else{
                            $_SESSION['error'] = $conn->error;
                        }
                    }
                break;
                case 'Variable':
                    $account_code = mysqli_real_escape_string($conn, $_POST['account_code']);
                    $description = mysqli_real_escape_string($conn, $_POST['description']);
                    $trans_category = mysqli_real_escape_string($conn, $_POST['trans_category']);
                    $office = mysqli_real_escape_string($conn, $_POST['office']);
        
                    $sql ="SELECT account_code FROM tbl_transactions WHERE account_code = '$account_code' and remarks = 'active'";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0)
                    {
                        $_SESSION['error'] = "Transaction Code already in the list!";
                    }
                    else
                    {
                        if($trans_category == "Document")
                        {
                            $trans_no_of_copy = mysqli_real_escape_string($conn, $_POST['trans_no_of_copy']);
                            $sql = "INSERT INTO tbl_transactions (account_code, description, transaction_type, category, unit_inputted_by, no_of_copy, office_id, remarks) VALUES ('$account_code', '$description', 'Variable', '$trans_category', 'Office', '$trans_no_of_copy', '$office', 'active')";
                        }
                        else
                        {
                            $sql = "INSERT INTO tbl_transactions (account_code, description, transaction_type, category, unit_inputted_by, no_of_copy, office_id, remarks) VALUES ('$account_code', '$description', 'Variable', '$trans_category', 'Office', 'NO', '$office', 'active')";
                        }
                        
                        if($conn->query($sql)){
                            $_SESSION['success'] = 'Transaction added successfully';
                        }
                        else{
                            $_SESSION['error'] = $conn->error;
                        }
                    }
                break;
            }
        break;
        case 'edit':
            $account_code = mysqli_real_escape_string($conn, $_POST['editaccount_code']);
            $description = mysqli_real_escape_string($conn, $_POST['editdescription']);
            $amount = mysqli_real_escape_string($conn, $_POST['editamount']);
            $office = mysqli_real_escape_string($conn, $_POST['editoffice']);
            $sql ="UPDATE tbl_transactions SET description = '$description', amount = '$amount', office_id = '$office' WHERE account_code = '$account_code'";
            if($conn->query($sql)){
                $_SESSION['success'] = 'Transaction updated successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        break;
        case 'delete':
            $account_code = mysqli_real_escape_string($conn, $_POST['del_account_code']);
            $sql ="DELETE FROM tbl_transactions WHERE account_code = '$account_code'";
            if($conn->query($sql))
            {
                $_SESSION['success'] = 'Transaction deleted successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        break;
    }
	header('location: home.php');

?>