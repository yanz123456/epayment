<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT a.transaction_id, a.transaction_office_id, b.email, b.client_type, b.student_number, b.applicant_number, b.lastname, b.firstname, b.middlename, b.dob, b.maiden_name, b.sex, b.civil_status, b.contact_number, b.city_address, b.permanent_address, a.remarks FROM tbl_requests a INNER JOIN tbl_clients b ON a.`requestor_id` = b.`id` WHERE a.`transaction_id` = '$id'";
		$query = $conn->query($sql);
		$request_details = $query->fetch_assoc();

        $transaction_details = array();
        if($request_details)
        {
            
            $sql2 = "SELECT
            a.request_transactions_id,
            a.transaction_id,
            a.account_code,
            b.description AS transaction_name,
            a.amount,
            a.quantity_of_unit,
            a.no_of_copies AS request_no_of_copies
          FROM
            tbl_request_transactions a
            INNER JOIN tbl_transactions b
              ON a.`account_code` = b.`account_code`
          WHERE a.transaction_id = '$id'";
            $query2 = $conn->query($sql2);
            while($row2 = $query2->fetch_assoc())
            {
                $transaction_details[] = $row2;
            }
        }
        $response = array(
        "request_details" => $request_details,
        "transaction_details" => $transaction_details
        );

		echo json_encode($response);
	}
?>