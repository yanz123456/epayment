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
                  <th>Remarks</th>
                  <th>Date</th>
                  <th width='10%'></th>
                </thead>
                <tbody id="requests_table">
                  <?php
                    $office_id = $_SESSION['office_id'];

                    $sql = "SELECT a.*, b.* FROM tbl_requests a LEFT JOIN tbl_clients b ON a.`requestor_id` = b.`id` WHERE a.`transaction_office_id` = '$office_id' AND a.`remarks` = 'Accepted' AND b.`client_type` = 'Student' ORDER BY a.`transaction_date` ASC";
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
                          <td><button class='col-xs-12 btn btn-primary btn-sm view btn-flat' data-transaction_id='$transaction_id'><i class='fa fa-eye'></i> View</button></td>
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
  <?php include 'includes/accepted_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
  var total_amount = 0;
  var compute_trigger = 0;
$(function(){
    $("#client_type").on("change", function(e)
    {
        var client_type = $(this).val();
        $.get("loadrequesttable2.php?client_type=" + client_type, function( data ) 
        {
        $("#requests_table").html(data);
        });
    });

    $(document).on('click', '.view', function(e)
    {
      e.preventDefault();
      var id = $(this).data("transaction_id");
      $.ajax({
        type: 'POST',
        url: 'get_transaction_details2.php',
        data: {id:id},
        dataType: 'json',
        success: function(response)
        {
          console.log(response);
          if(response.request_details.client_type == "Student")
          {
            var appendrow = '<tr>' +
                              '<td width="20%">Transaction #:</td>' +
                              '<td width="30%"><input type="hidden" name="transaction_id" value="'+response.request_details.transaction_id+'"><b>' + response.request_details.transaction_id + '</b></td>' +
                              '<td width="20%">Student #:</td>' +
                              '<td width="30%"><b>' + response.request_details.student_number + '</b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">Fullname:</td>' +
                              '<td width="30%"><b>' + response.request_details.lastname + ", " +  response.request_details.firstname + " " + response.request_details.middlename + '</b></td>' +
                              '<td width="20%">Maiden Name:</td>' +
                              '<td width="30%"><b>' + response.request_details.maiden_name + '</b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">Email:</td>' +
                              '<td width="30%"><b>' + response.request_details.email + '</b></td>' +
                              '<td width="20%">Civil Status:</td>' +
                              '<td width="30%"><b>' + response.request_details.civil_status + '</b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">Contact Number:</td>' +
                              '<td width="30%"><b>' + response.request_details.contact_number + '</b></td>' +
                              '<td width="20%">Sex:</td>' +
                              '<td width="30%"><b>' + response.request_details.sex + '</b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">City Address:</td>' +
                              '<td width="30%"><b>' + response.request_details.city_address + '</b></td>' +
                              '<td width="20%">Permanent Address:</td>' +
                              '<td width="30%"><b>' + response.request_details.permanent_address + '</b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">Date of Birth:</td>' +
                              '<td width="30%"><b>' + response.request_details.dob + '</b></td>' +
                              '<td width="20%">Transaction Remarks:</td>' +
                              '<td width="30%"><b>' + response.request_details.remarks + '</b></td>' +
                            '</tr>';
          }
          else if(response.request_details.client_type == "Applicant")
          {
            var appendrow = '<tr>' +
                              '<td width="20%">Transaction #:</td>' +
                              '<td width="30%"><input type="hidden" name="transaction_id" value="'+response.request_details.transaction_id+'"><b>' + response.request_details.transaction_id + '</b></td>' +
                              '<td width="20%">Applicant #:</td>' +
                              '<td width="30%"><b>' + response.request_details.applicant_number + '</b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">Fullname:</td>' +
                              '<td width="30%"><b>' + response.request_details.lastname + ", " +  response.request_details.firstname + " " + response.request_details.middlename + '</b></td>' +
                              '<td width="20%">Maiden Name:</td>' +
                              '<td width="30%"><b>' + response.request_details.maiden_name + '</b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">Email:</td>' +
                              '<td width="30%"><b>' + response.request_details.email + '</b></td>' +
                              '<td width="20%">Civil Status:</td>' +
                              '<td width="30%"><b>' + response.request_details.civil_status + '</b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">Contact Number:</td>' +
                              '<td width="30%"><b>' + response.request_details.contact_number + '</b></td>' +
                              '<td width="20%">Sex:</td>' +
                              '<td width="30%"><b>' + response.request_details.sex + '</b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">City Address:</td>' +
                              '<td width="30%"><b>' + response.request_details.city_address + '</b></td>' +
                              '<td width="20%">Permanent Address:</td>' +
                              '<td width="30%"><b>' + response.request_details.permanent_address + '</b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">Date of Birth:</td>' +
                              '<td width="30%"><b>' + response.request_details.dob + '</b></td>' +
                              '<td width="20%">Transaction Remarks:</td>' +
                              '<td width="30%"><b>' + response.request_details.remarks + '</b></td>' +
                            '</tr>';
          }
          else
          {
            var appendrow = '<tr>' +
                              '<td width="20%">Transaction #:</td>' +
                              '<td width="30%"><input type="hidden" name="transaction_id" value="'+response.request_details.transaction_id+'"><b>' + response.request_details.transaction_id + '</b></td>' +
                              '<td width="20%">External Client:</td>' +
                              '<td width="30%"><b></b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">Fullname:</td>' +
                              '<td width="30%"><b>' + response.request_details.lastname + ", " +  response.request_details.firstname + " " + response.request_details.middlename + '</b></td>' +
                              '<td width="20%">Maiden Name:</td>' +
                              '<td width="30%"><b>' + response.request_details.maiden_name + '</b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">Email:</td>' +
                              '<td width="30%"><b>' + response.request_details.email + '</b></td>' +
                              '<td width="20%">Civil Status:</td>' +
                              '<td width="30%"><b>' + response.request_details.civil_status + '</b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">Contact Number:</td>' +
                              '<td width="30%"><b>' + response.request_details.contact_number + '</b></td>' +
                              '<td width="20%">Sex:</td>' +
                              '<td width="30%"><b>' + response.request_details.sex + '</b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">City Address:</td>' +
                              '<td width="30%"><b>' + response.request_details.city_address + '</b></td>' +
                              '<td width="20%">Permanent Address:</td>' +
                              '<td width="30%"><b>' + response.request_details.permanent_address + '</b></td>' +
                            '</tr>' +
                            '<tr>' +
                              '<td width="20%">Date of Birth:</td>' +
                              '<td width="30%"><b>' + response.request_details.dob + '</b></td>' +
                              '<td width="20%">Transaction Remarks:</td>' +
                              '<td width="30%"><b>' + response.request_details.remarks + '</b></td>' +
                            '</tr>';
          }

          $("#list_of_request tbody").empty();
          var appendrow2 = "";
          var total_amount = 0;
          
          $.each(response.transaction_details, function(i, item)
          {
            
            total_amount += parseFloat(response.transaction_details[i].amount);
            appendrow2 = "<tr>" +
                            "<td>" + response.transaction_details[i].transaction_name + "</td>" +

                            "<td align='right'>Php " + response.transaction_details[i].amount + "</td>" +

                            "<td>" + response.transaction_details[i].quantity_of_unit + "</td>" +

                            "<td>" + response.transaction_details[i].request_no_of_copies + "</td>" +

                            "<td align='right'>Php " + response.transaction_details[i].amount + "</td>" +
                          "</tr>";
            $("#list_of_request").append(appendrow2);
          });

          $("#transaction_details tbody").html(appendrow);
          $("#total_amount_print").html(total_amount.toFixed(2));
        }
      });
      $("#process").modal("show");
    });
});
</script>
</body>
</html>