<?php 
	include '../admin_module/admin/includes/conn.php';

    
    $account_code = $_POST['account_code'];
    $quantity_of_unit = $_POST['quantity_of_unit'];
    $no_of_copies = $_POST['no_of_copies'];

    $amount_arr = array();
    $description_arr = array();
    $unit_arr = array();
    $note_arr = array();
    $office_arr = array();
    $account_code_arr = array();
    $quantity_of_unit_arr = array();
    $no_of_copies_arr = array();
    $transaction_types = array();

    if(count($account_code) > 0)
    {
        for($i = 0; $i < count($account_code); $i++)
        {
            $sql = "SELECT account_code FROM tbl_transactions WHERE account_code = '".$account_code[$i]."' AND remarks = 'active' LIMIT 1";
            $query = $conn->query($sql);
            if($query)
            {
                $sql = "SELECT a.*, b.description as office_name FROM tbl_transactions a LEFT JOIN tbl_offices b ON a.office_id = b.id WHERE a.account_code = '".$account_code[$i]."' AND a.remarks = 'active' LIMIT 1";
                $query = $conn->query($sql);
                $row = $query->fetch_assoc();
                $transaction_types[] = $row["transaction_type"];
                $description_arr[] = $row["description"];
                $unit_arr[] = $row["unit"];
                $note_arr[] = $row["note"];
                $office_arr[] = $row["office_name"];
                $amount_arr[] = $row["amount"];
                $account_code_arr[] = $account_code[$i];
                $quantity_of_unit_arr[] = $_POST['quantity_of_unit'][$i];
                $no_of_copies_arr[] = $_POST['no_of_copies'][$i];
            }
            else
            {
                $response = array(
                    "status" => "error",
                    "text" => "There is an error fetching data of transaction selected. Please try again!"
                );
            }
        }

        if(in_array("Fixed With Unit", $transaction_types) || in_array("Variable", $transaction_types))
        {
            $response = array(
                "account_code" => $account_code_arr,
                "amount" => $amount_arr,
                "description" => $description_arr,
                "unit" => $unit_arr,
                "note" => $note_arr,
                "office" => $office_arr,
                "quantity_of_unit" => $quantity_of_unit_arr,
                "no_of_copies" => $no_of_copies_arr,
                "status" => "success",
                "total_amount" => "Will be indicated in Order of Payment"
            );
        }
        else
        {
            for($i = 0; $i < count($account_code_arr); $i++)
            {
                $total_amount += $no_of_copies_arr[$i] * $amount_arr[$i];
            }
            $response = array(
                "account_code" => $account_code_arr,
                "amount" => $amount_arr,
                "description" => $description_arr,
                "unit" => $unit_arr,
                "note" => $note_arr,
                "office" => $office_arr,
                "quantity_of_unit" => $quantity_of_unit_arr,
                "no_of_copies" => $no_of_copies_arr,
                "status" => "success",
                "total_amount" => "Php ".number_format($total_amount,2)
            );
        }
        
    }
    else
    {
        $response = array(
            "status" => "error",
            "text" => "There is an error fetching data of transaction selected. Please try again!"
        );
    }

    echo json_encode($response);
?>