<?php
	include 'includes/session.php';
    $checkdataredundant = 0;
    $checkfailedemail = 0;
    $checkitemsfromtblreferencenumbers = 0;

    if(isset($_POST["import"]))
    {
        $name = $_FILES["file"]["name"];
        $ext = end((explode(".", $name))); # extra () to prevent notice

        if($ext != "csv")
        {
            $_SESSION['error'] = "Invalid uploaded file!";
        }
        else
        {
            $fileName = $_FILES["file"]["tmp_name"];
            if($_FILES["file"]["size"] > 0)
            {
                $file = fopen($fileName, "r");
                while(($column = fgetcsv($file, 1000, ",")) !== FALSE)
                {
                    //check if item is present in tbl_requests
                    $sql = "SELECT * FROM tbl_requests WHERE transaction_id = '" . $conn->escape_string($column[6]) . "'";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0)
                    {
                        //if yes
                        //INSERT IN PAYMENTS TABLE
                        $date_of_payment1 = $conn->escape_string($column[0]);
                        $date_of_payment_post1 = date("Y:m:d", strtotime($date_of_payment1));

                        $sql = "SELECT * FROM tbl_payments WHERE transaction_id = '" . $conn->escape_string($column[6]) . "' AND amount_paid = '" . $conn->escape_string($column[11]) . "' AND date_of_payment = '" . $date_of_payment_post1 . "'";
                        $result = $conn->query($sql);
                        if($result->num_rows <= 0)
                        {
                            //INSERT IN PAYMENTS TABLE
                            $date_of_payment = $conn->escape_string($column[0]);
                            $date_of_payment_post = date("Y-m-d", strtotime($date_of_payment));

                            $sql = "INSERT INTO tbl_payments (transaction_id, amount_paid, date_of_payment, `status`) VALUES ('" . $conn->escape_string($column[6]) . "', '" . $conn->escape_string($column[11]) . "', '" . $date_of_payment_post . "', 'pending')";
                            $result = $conn->query($sql);
                            if($result)
                            {
                                $_SESSION['success'] = "Payments Uploaded Successfully!";
                            }
                            else
                            {
                                $_SESSION['error'] = "There is an error encountered during the upload! Please try again!";
                            }
                        }
                    }
                    else
                    {
                        //IF NO CHECK FIRST IF ALREADY IN PAYMENT ERRORS TABLE
                        $sql = "SELECT * FROM tbl_paymenterrors WHERE transaction_id = '" . $conn->escape_string($column[6]) . "'";
                        $result = $conn->query($sql);
                        if($result->num_rows <= 0)
                        {
                            $date_of_payment_errors = $conn->escape_string($column[0]);
                            $date_of_payment_errors_post = date("Y-m-d", strtotime($date_of_payment_errors));

                            $transaction_id = $conn->escape_string($column[6]);
                            $lastname = $conn->escape_string($column[2]);
                            $firstname = $conn->escape_string($column[3]);
                            $middlename = $conn->escape_string($column[4]);
                            $amount_paid = $conn->escape_string($column[11]);



                            $sql = "INSERT INTO tbl_paymenterrors (transaction_id, last_name, first_name, middle_name, amount_paid, date_of_payment) VALUES ('$transaction_id', '$lastname', '$firstname', '$middlename', '$amount_paid', '$date_of_payment_errors_post')";
                            $conn->query($sql);
                            $checkitemsfromtblreferencenumbers = 1;

                            $_SESSION['success'] = "File Uploaded Successfully! There is payment errors encountered!";
                        }
                    }
                }
            }
        }
    }
    else
    {
        $_SESSION['error'] = "Invalid Request!";
    }

    
    
    header('location: transaction_management.php');
?>