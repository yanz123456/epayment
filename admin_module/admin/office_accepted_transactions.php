<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar_office.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Accepted Transactions
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage</a></li>
        <li class="active">Accepted Transactions</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
            <div class="row">
                <label for="title" class="col-sm-1 control-label">Client Type:</label>
                <div class="col-sm-3">
                    <select class="form-control" id="client_type" name="client_type" required>
                      <option value="Student">Student</option>
                      <option value="Applicant">Applicant</option>
                      <option value="External">External</option>
                    </select>
                    <input type="hidden" id="transaction_type"/>
                </div>
              </div>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered">
                    <thead>
                    <th>Client Type</th>
                    <th>Transaction #</th>
                    <th>Requestor #</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Account Code</th>
                    <th>Transaction</th>
                    <th>Amount To Pay</th>
                    <th>Quantity</th>
                    <th>Note</th>
                    <th>Remarks</th>
                    <th>Date</th>
                    <th>Date Accepted</th>
                    </thead>
                    <tbody id="requests_table">
                    <?php
                        $office_id = $_SESSION['office_id'];

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
                    ?>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/transaction_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
    $("#client_type").on("change", function(e)
    {
        var client_type = $(this).val();
        $.get("loadrequesttable2.php?client_type=" + client_type, function( data ) 
        {
        $("#requests_table").html(data);
        });
    });
});
</script>
</body>
</html>