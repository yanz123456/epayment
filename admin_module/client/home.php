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
        Transactions
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add New Transaction</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Account Code</th>
                  <th>Amount Type</th>
                  <th>Description</th>
                  <th>Office</th>
                  <th>Amount</th>
                  <th>Unit</th>
                  <th></th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT a.*, b.description as office_name, IFNULL(a.unit, '-') as unitadded FROM tbl_transactions a LEFT JOIN tbl_offices b ON a.office_id = b.id WHERE a.remarks = 'active'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td>".$row['account_code']."</td>
                          <td>".$row['transaction_type']."</td>
                          <td>".$row['description']."</td>
                          <td>".$row['office_name']."</td>
                          <td align='right'>P ".number_format($row['amount'], 2)."</td>
                          <td>".$row['unitadded']."</td>
                          <td>
                            <button class='col-xs-12 btn btn-success btn-sm edit btn-flat' data-id='".$row['account_code']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='col-xs-12 btn btn-danger btn-sm delete btn-flat' data-id='".$row['account_code']."'><i class='fa fa-trash'></i> Delete</button>
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
</div>
<?php include 'includes/scripts.php'; ?>
<?php include 'includes/transaction_modal.php'; ?>
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
    $("#dynamicinputs2").empty();

    $("#dynamicinputs").append("<div class='form-group'><label for='title' class='col-sm-3 control-label'>Category:</label><div class='col-sm-9'><select class='form-control' id='trans_category' name='trans_category' required><option disabled selected hidden value=''>-- Select Category --</option><option value='Document'>Document</option><option value='Service'>Service</option></select></div></div>");
  });

  $(document).on("change", "#trans_category", function(e){
    e.preventDefault();
    $("#dynamicinputs2").empty();

    var category = $("#trans_category").val();
    var transtype = $("#trans_type").val();

    if(transtype == "Fixed")
    {
      if(category == "Document")
      {
        $("#dynamicinputs2").append("<div class='form-group'><label for='title' class='col-sm-3 control-label'>Amount:</label><div class='col-sm-9'><input type='number' step='0.01' class='form-control' id='amount' name='amount' required autocomplete='off'></div></div> <div class='form-group'><label for='title' class='col-sm-3 control-label'>Can be more than 1 copy?:</label><div class='col-sm-9'><select class='form-control' id='trans_no_of_copy' name='trans_no_of_copy' required><option disabled selected hidden value=''>-- Select Answer --</option><option value='YES'>YES</option><option value='NO'>NO</option></select></div></div>");
      }
      else
      {
        $("#dynamicinputs2").append("<div class='form-group'><label for='title' class='col-sm-3 control-label'>Amount:</label><div class='col-sm-9'><input type='text' class='form-control' id='amount' name='amount' required autocomplete='off'></div></div>");
      }
    }
    else if(transtype == "Fixed With Unit")
    {
      if(category == "Document")
      {
        $("#dynamicinputs2").append("<div class='form-group'><label for='title' class='col-sm-3 control-label'>Amount:</label><div class='col-sm-9'><input type='text' class='form-control' id='amount' name='amount' required autocomplete='off'></div></div> <div class='form-group'><label for='title' class='col-sm-3 control-label'>Unit:</label><div class='col-sm-9'><select class='form-control' name='unit' required><option disabled hidden selected value=''>--Select Unit--</option><option value='per page'>per page</option><option value='per head'>per head</option><option value='per item'>per item</option><option value='per kilo'>per kilo</option><option value='per day'>per day</option><option value='per subject'>per subject</option></select></div></div> <div class='form-group'><label for='title' class='col-sm-3 control-label'>Unit Inputted By:</label><div class='col-sm-9'><select class='form-control' name='trans_unit_inputtedby' required><option disabled selected hidden value=''>-- Select Designation --</option><option value='Client'>Client</option><option value='Office'>Office</option></select></div></div> <div class='form-group'><label for='title' class='col-sm-3 control-label'>Can be more than 1 copy?:</label><div class='col-sm-9'><select class='form-control' id='trans_no_of_copy' name='trans_no_of_copy' required><option disabled selected hidden value=''>-- Select Answer --</option><option value='YES'>YES</option><option value='NO'>NO</option></select></div></div>");
      }
      else
      {
        $("#dynamicinputs2").append("<div class='form-group'><label for='title' class='col-sm-3 control-label'>Amount:</label><div class='col-sm-9'><input type='text' class='form-control' id='amount' name='amount' required autocomplete='off'></div></div> <div class='form-group'><label for='title' class='col-sm-3 control-label'>Unit:</label><div class='col-sm-9'><select class='form-control' name='unit' required><option disabled hidden selected value=''>--Select Unit--</option><option value='per head'>per head</option><option value='per page'>per page</option><option value='per item'>per item</option><option value='per kilo'>per kilo</option><option value='per day'>per day</option><option value='per subject'>per subject</option></select></div></div> <div class='form-group'><label for='title' class='col-sm-3 control-label'>Unit Inputted By:</label><div class='col-sm-9'><select class='form-control' name='trans_unit_inputtedby' required><option disabled selected hidden value=''>-- Select Designation --</option><option value='Client'>Client</option><option value='Office'>Office</option></select></div></div>");
      }
    }
    else
    {
      if(category == "Document")
      {
        $("#dynamicinputs2").append("<div class='form-group'><label for='title' class='col-sm-3 control-label'>Can be more than 1 copy?:</label><div class='col-sm-9'><select class='form-control' id='trans_no_of_copy' name='trans_no_of_copy' required><option disabled selected hidden value=''>-- Select Answer --</option><option value='YES'>YES</option><option value='NO'>NO</option></select></div></div>");
      }
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