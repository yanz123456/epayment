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
        Transaction Requests
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage</a></li>
        <li class="active">Transaction Requests</li>
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
                  <th>Amount</th>
                  <th>Note</th>
                  <th>Remarks</th>
                  <th>Date</th>
                  <th></th>
                </thead>
                <tbody id="requests_table">
                  <?php
                    $office_id = $_SESSION['office_id'];

                    $sql = "SELECT a.*, b.description, IFNULL(b.amount, 0.00) as amount, a.remarks AS transaction_remarks, CONCAT(a.requestor_LName, ', ', a.requestor_GName, ' ', a.requestor_MName) as full_name, a.requestor_Email FROM tbl_requests a LEFT JOIN tbl_transactions b ON a.`account_code` = b.account_code LEFT JOIN tbl_offices c ON b.office_id = c.id WHERE b.office_id = '$office_id' AND a.remarks = 'Pending' AND a.requestor_type = 'Student' ORDER BY a.transaction_date ASC";
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
  <?php include 'includes/office_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>

$(function()
{
  $('#example1').on('click', '.process', function (e) {
    e.preventDefault();
    var transaction_id = $(this).data("transaction_id");
    var account_code = $("#tr" + transaction_id + " td:nth-child(6)").text();
    $("#transaction_number").val(transaction_id);
    $("#client_type_confirm").val($("#tr" + transaction_id + " td:nth-child(1)").text());
    $("#requestor_id").val($("#tr" + transaction_id + " td:nth-child(3)").text());
    $("#requestor_name").val($("#tr" + transaction_id + " td:nth-child(4)").text());
    $("#rqeuestor_email").val($("#tr" + transaction_id + " td:nth-child(5)").text());
    $("#account_code").val($("#tr" + transaction_id + " td:nth-child(6)").text());
    $("#transaction").val($("#tr" + transaction_id + " td:nth-child(7)").text());
    $("#notes").val($("#tr" + transaction_id + " td:nth-child(9)").text());
    getTransactionType(account_code);
  });

  $('#example1').on('click', '.decline', function (e) {
    e.preventDefault();
    var transaction_id = $(this).data("transaction_id");
    var account_code = $("#tr" + transaction_id + " td:nth-child(6)").text();
    $("#del_transaction_number").val(transaction_id);
    $("#del_client_type").val($("#tr" + transaction_id + " td:nth-child(1)").text());
    $("#del_requestor_id").val($("#tr" + transaction_id + " td:nth-child(3)").text());
    $("#del_requestor_name").val($("#tr" + transaction_id + " td:nth-child(4)").text());
    $("#del_rqeuestor_email").val($("#tr" + transaction_id + " td:nth-child(5)").text());
    $("#del_account_code").val($("#tr" + transaction_id + " td:nth-child(6)").text());
    $("#del_transaction").val($("#tr" + transaction_id + " td:nth-child(7)").text());
    $("#del_notes").val($("#tr" + transaction_id + " td:nth-child(9)").text());
    $('#decline').modal('show');
  });

  $("#client_type").on("change", function(e)
  {
    var client_type = $(this).val();
    $.get("loadrequesttable.php?client_type=" + client_type, function( data ) 
    {
      $("#requests_table").html(data);
    });
  });

  $("#amountinputs").on('change', '#quantity', function()
  {
    var quantity = $(this).val();
    var amount = $("#amount_per_unit").val();
    
    var total_amount  = quantity * amount;
    total_amount = Math.round((total_amount + Number.EPSILON) * 100) / 100;
    total_amount = parseFloat(total_amount).toFixed(2)
    $("#total_amount").val(total_amount);
  });

  $("#amountinputs").on('keyup', '#quantity', function()
  {
    var quantity = $(this).val();
    var amount = $("#amount_per_unit").val();
    
    var total_amount  = quantity * amount;
    total_amount = Math.round((total_amount + Number.EPSILON) * 100) / 100;
    total_amount = parseFloat(total_amount).toFixed(2)
    $("#total_amount").val(total_amount);
  });
});

function getTransactionType(id)
{
  $.ajax({
    type: 'POST',
    url: 'transaction_type.php',
    data: {id:id},
    dataType: 'json',
    success: function(response)
    {
      var transaction_type;
      transaction_type = response.transaction_type;

      if(transaction_type == "Fixed")
      {
        var amount = response.amount
        $("#amountinputs").empty();
        $("#type_of_transaction").val("Fixed");
        $("#amountinputs").append("<div class='form-group'><label for='title' class='col-sm-3 control-label'>Amount:</label><div class='col-sm-9'><input type='number' class='form-control' id='amount_confirm' name='amount_confirm' required readonly></div></div>");
        $("#amount_confirm").val(amount);
        $("#amount_to_post").val(amount);
        $('#process').modal('show');
      }
      else if(transaction_type == "Fixed With Unit")
      {
        $("#amountinputs").empty();
        $("#type_of_transaction").val("Fixed With Unit");
        $("#amountinputs").append("<div class='form-group'><label for='title' class='col-sm-3 control-label'>Amount:</label><div class='col-sm-9'><input type='text' class='form-control' id='amount_per_unit' name='amount_per_unit' required readonly></div></div> <div class='form-group'><label for='title' class='col-sm-3 control-label'>Unit:</label><div class='col-sm-9'><input type='text' class='form-control' id='unit' name='unit' required readonly></div></div> <div class='form-group'><label for='title' class='col-sm-3 control-label'>Quantity:</label><div class='col-sm-9'><input type='number' class='form-control' id='quantity' name='quantity' required autocomplete='off'></div></div> <div class='form-group'><label for='title' class='col-sm-3 control-label'>Total Amount:</label><div class='col-sm-9'><input type='text' class='form-control' id='total_amount' name='total_amount' required readonly></div></div>");
        $("#amount_per_unit").val(response.amount);
        $("#unit").val(response.unit);
        $('#process').modal('show');
      }
      else
      {
        $("#amountinputs").empty();
        $("#type_of_transaction").val("Variable");
        $("#amountinputs").append("<div class='form-group'><label for='title' class='col-sm-3 control-label'>Amount:</label><div class='col-sm-9'><input type='number' class='form-control' id='amount' name='amount' required></div></div>");
        $('#process').modal('show');
      }
    }
  });
}
</script>
</body>
</html>