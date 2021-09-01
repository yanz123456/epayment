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
              <form action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
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
  $("#import").on("click", function () {
      alert("The system is now trying to validate the process.\nPlease wait for the page to load again.");
      $("#frmCSVImport").submit();
  });

  $("#frmCSVImport").on("submit", function () {
      $("#response").attr("class", "");
      $("#response").html("");
      var fileType = ".csv";
      var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
      if (!regex.test($("#file").val().toLowerCase())) {
              $("#response").addClass("error");
              $("#response").addClass("display-block");
          $("#response").html("Invalid File. Upload: <b>" + fileType + "</b> File(s) Only.");
          return false;
      }
      return true;
  });
});
</script>
</body>
</html>