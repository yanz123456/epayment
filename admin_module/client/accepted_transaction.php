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

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        My Pending Transactions
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Pending Transactions</li>
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
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Client Type</th>
                  <th>Transaction #</th>
                  <th>Requestor #</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Remarks</th>
                  <th>Date</th>
                  <th width="10%"></th>
                </thead>
                <tbody id="requests_table">
                  <?php
                    $client_id = $_SESSION['login_id'];

                    $sql = "SELECT a.*, b.* FROM tbl_requests a LEFT JOIN tbl_clients b ON a.`requestor_id` = b.`id` WHERE a.`requestor_id` = '$client_id' AND a.`remarks` = 'Accepted' ORDER BY a.`transaction_date` ASC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc())
                    {
                      $client_type = $row['client_type'];
                      $transaction_id = $row['transaction_id'];
                      if($row['client_type'] == "Student")
                      {
                        $requestor_id = $row['student_number'];
                      }
                      elseif($row['client_type'] == "Applicant")
                      {
                        $requestor_id = $row['applicant_number'];
                      }
                      else
                      {
                        $requestor_id = "--";
                      }
                      $full_name = $row['lastname'].", ".$row["firstname"]." ".$row["middlename"];
                      $email = $row['email'];
                      $remarks = $row['remarks'];
                      $transaction_date = date('M d, Y h:i:s A', strtotime($row['transaction_date']));
                      
                      echo "
                        <tr id='tr$transaction_id'>
                          <td>$client_type</td>
                          <td>$transaction_id</td>
                          <td>$requestor_id</td>
                          <td>$full_name</td>
                          <td>$email</td>
                          <td>$remarks</td>
                          <td>$transaction_date</td>
                          <td><button class='col-xs-12 btn btn-primary btn-sm view btn-flat' data-transaction_id='$transaction_id'><i class='fa fa-eye'></i> View Order of Payment</button></td>
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
<script>

$(function()
{
    $(document).on('click', '.view', function(e){
        var transaction_id = $(this).data("transaction_id");
        window.open("../../reports/referencereceiptinit.php?transaction_id=" + transaction_id, '_blank');
    });

});

</script>
</body>
</html>