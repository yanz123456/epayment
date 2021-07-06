<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<style>
    table {
    table-layout: fixed ;
    width: 100% ;
    }
    td {
    width: 25% ;
    }
</style>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pending Transactions
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage</a></li>
        <li class="active">Transactions</li>
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Upload Landbank File</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Student #</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Account Code</th>
                  <th>Transaction</th>
                  <th>Amount</th>
                  <th>Office</th>
                  <th>Remarks</th>
                  <th></th>
                </thead>
                <tbody>
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
  $('#example1').on('click', '.edit', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
    $('#editnew').modal('show');
  });

  $('#example1').on('click', '.delete', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
    $('#delete').modal('show');
  });

  $('#trans_type').on('change', function (e) {
    e.preventDefault();
    $("#dynamicinputs").empty();
    var transtype = $(this).val();
    if(transtype == "Fixed")
    {
      $("#dynamicinputs").append("<div class='form-group'><label for='title' class='col-sm-3 control-label'>Amount:</label><div class='col-sm-9'><input type='text' class='form-control' id='amount' name='amount' required autocomplete='off'></div></div>")
    }
    else if(transtype == "Fixed With Unit")
    {
      $("#dynamicinputs").append("<div class='form-group'><label for='title' class='col-sm-3 control-label'>Amount:</label><div class='col-sm-9'><input type='text' class='form-control' id='amount' name='amount' required autocomplete='off'></div></div> <div class='form-group'><label for='title' class='col-sm-3 control-label'>Unit:</label><div class='col-sm-9'><select class='form-control' name='unit' required><option disabled hidden selected value=''>--Select Unit--</option><option value='per page'>per page</option><option value='per item'>per item</option></select></div></div>")
    }
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'transaction_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#editaccount_code').val(response.account_code);
      $('#editdescription').val(response.description);
      $('#editamount').val(response.amount);
      $('#editoffice').val(response.office_id);

      $('#del_account_code').val(response.account_code);
      $('#del_account_code1').html(response.account_code);
      $('#del_account_description').html(response.description);
    }
  });
}
</script>
</body>
</html>