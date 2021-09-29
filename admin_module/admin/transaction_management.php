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

<?php 
    
?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaction Management
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage</a></li>
        <li class="active">Transaction Management</li>
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
              <form action="upload_file.php" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                <div class="col-md-3">
                    <label>Import File:</label>
                    <input class="form-control" type="file" name="file" id="file" accept=".csv" required/>
                </div>
                <div class="col-md-3">
                    <label style="color:white;">-</label>
                    <button class='btn btn-success form-control btn-submit' id="import" name="import" style="font-weight: bold">UPLOAD</button>
                </div>
              </form>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Transaction #</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Client Type</th>
                  <th>Amount</th>
                  <th>Date of Payment</th>
                  <th>Date of Import</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT 
                    a.transaction_id,
                    b.requestor_id,
                    CONCAT(
                      c.lastname,
                      ', ',
                      c.firstname,
                      ' ',
                      c.middlename
                    ) AS fullname,
                    c.email,
                    c.client_type,
                    a.amount_paid,
                    a.date_of_payment,
                    a.date_of_import
                    FROM tbl_payments a
                    LEFT JOIN tbl_requests b ON a.`transaction_id` = b.`transaction_id`
                    LEFT JOIN tbl_clients c ON b.`requestor_id` = c.`id`
                    WHERE a.`status` = 'pending'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc())
                    {
                      $transaction_id = $row['transaction_id'];
                      $fullname = $row['fullname'];
                      $email = $row['email'];
                      $client_type = $row['client_type'];
                      $amount_paid = $row['amount_paid'];
                      $date_of_payment = $row['date_of_payment'];
                      $date_of_import = $row['date_of_import'];
                      echo "
                        <tr>
                          <td>$transaction_id</td>
                          <td>$fullname</td>
                          <td>$email</td>
                          <td>$client_type</td>
                          <td align='right'>Php $amount_paid</td>
                          <td>$date_of_payment</td>
                          <td>$date_of_import</td>
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
});
</script>
</body>
</html>