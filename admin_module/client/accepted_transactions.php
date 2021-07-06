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
        My Accepted Transactions
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Transaction #</th>
                  <th>Student #</th>
                  <th>Account Code</th>
                  <th>Transaction</th>
                  <th>Amount To Pay</th>
                  <th>Office</th>
                  <th>Additional Note</th>
                  <th>Remarks</th>
                  <th></th>
                </thead>
                <tbody>
                  <?php
                    $studno = $_SESSION["client"];
                    $client_type = $_SESSION["client_type"];
                    $sql = "SELECT a.*, b.description, c.description AS officedesc FROM tbl_requests a LEFT JOIN tbl_transactions b ON a.`account_code` = b.account_code LEFT JOIN tbl_offices c ON b.office_id = c.id WHERE a.requestor_id = '$studno' AND a.requestor_type = '$client_type' AND a.remarks = 'Accepted'";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc())
                    {
                      $transaction_id = $row['transaction_id'];
                      $account_code = $row['account_code'];
                      $StudNo = $row['requestor_id'];
                      $description = $row['description'];
                      $amount = $row['amount_to_pay'];
                      $officedesc = $row['officedesc'];
                      $note = $row['note'];
                      $remarks = $row['remarks'];

                      echo "
                        <tr>
                          <td>$transaction_id</td>
                          <td>$StudNo</td>
                          <td>$account_code</td>
                          <td>$description</td>
                          <td align='right'>P $amount</td>
                          <td>$officedesc</td>
                          <td>$note</td>
                          <td>$remarks</td>";
                      if($remarks != "Pending")
                      {
                        echo "
                            <td>
                              <button class='col-xs-12 btn btn-success btn-sm process btn-flat' data-id='$account_code'><i class='fa fa-eye'></i> View Order of Payment</button>
                            </td>
                          </tr>
                        ";
                      }
                      else
                      {
                        echo "
                            <td>
                            </td>
                          </tr>
                        ";
                      }
                      
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
</script>
</body>
</html>