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
  <?php include 'includes/menubar_office.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Requests (External)
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage</a></li>
        <li class="active">Requests (External)</li>
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
                  <th></th>
                </thead>
                <tbody>
                  <?php
                    $office_id = $_SESSION["office_id"];
                    $sql = "SELECT a.*, b.description, b.amount, c.description AS officedesc FROM tbl_requests_external a LEFT JOIN tbl_transactions b ON a.`transaction_id` = b.account_code LEFT JOIN tbl_offices c ON b.office_id = c.id WHERE b.office_id = '$office_id' AND a.remarks = 'Pending'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc())
                    {
                        $account_code = $row['transaction_id'];
                        $requestor_id = $row['requestor_id'];
                        $LName = $row['LName'];
                        $FName = $row['FName'];
                        $MName = $row['MName'];
                        $Email = $row['Email'];
                        $description = $row['description'];
                        $amount = $row['amount'];
                        $officedesc = $row['officedesc'];
                      echo "
                        <tr>
                          <td>$requestor_id</td>
                          <td>$LName, $FName $MName</td>
                          <td>$Email</td>
                          <td>$account_code</td>
                          <td>$description</td>
                          <td>$amount</td>
                          <td>$officedesc</td>
                          <td>
                            <button class='col-xs-12 btn btn-success btn-sm process btn-flat' data-id='$account_code'><i class='fa fa-check'></i> Process</button>
                            <button class='col-xs-12 btn btn-danger btn-sm delete btn-flat' data-id='$account_code'><i class='fa fa-trash'></i> Decline</button>
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
  <?php include 'includes/transaction_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('#example1').on('click', '.edit', function (e) {
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('#example1').on('click', '.delete', function (e) {
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');  
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'department_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#depid').val(response.id);
      $('#edit_title').val(response.description);
      $('#del_depid').val(response.id);
      $('#del_position').html(response.description);
    }
  });
}
</script>
</body>
</html>