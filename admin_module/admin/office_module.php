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
                  <th>Remarks</th>
                  <th>Date</th>
                  <th width="10%"></th>
                </thead>
                <tbody id="requests_table">
                  <?php
                    $office_id = $_SESSION['office_id'];

                    $sql = "SELECT a.*, b.* FROM tbl_requests a LEFT JOIN tbl_clients b ON a.`requestor_id` = b.`id` WHERE a.`transaction_office_id` = '$office_id' AND a.`remarks` = 'Pending' AND b.`client_type` = 'Student' ORDER BY a.`transaction_date` ASC";
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
                          <td>
                            <button class='col-xs-12 btn btn-primary btn-sm process btn-flat' data-transaction_id='$transaction_id'><i class='fa fa-eye'></i> View</button>
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

  var total_amount = 0;
  var compute_trigger = 0;

$(function()
{
  $('#example1').on('click', '.process', function (e) {
    e.preventDefault();
    total_amount = 0;
    var id = $(this).data("transaction_id");
      $.ajax({
        type: 'POST',
        url: 'get_transaction_details.php',
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
          $.each(response.transaction_details, function(i, item)
          {
            if(response.transaction_details[i].transaction_type == "Fixed")
            {
              if(response.transaction_details[i].category == "Document")
              {
                var total_amount_pt = response.transaction_details[i].request_no_of_copies * response.transaction_details[i].amount;
                appendrow2 = "<tr>" +
                                "<td><input type='hidden' name='request_transactions_id[]' value='" + response.transaction_details[i].request_transactions_id + "'>" + response.transaction_details[i].transaction_name + "</td>" +

                                "<td align='right'>Php " + response.transaction_details[i].amount + "</td>" +

                                "<td><input type='hidden' name='qty_of_inputs[]' value='"+ response.transaction_details[i].quantity_of_unit +"'></td>" +

                                "<td><input type='hidden' name='no_of_copies[]' value='"+response.transaction_details[i].request_no_of_copies+"'>" + response.transaction_details[i].request_no_of_copies + "</td>" +

                                "<td align='right'><input type='text' class='form-control text-right amounts' name='total_amount[]' id='total_amount"+ response.transaction_details[i].request_transactions_id +"' value='"+total_amount_pt.toFixed(2)+"' readonly></td>" +
                              "</tr>";

                total_amount += total_amount_pt;
              }
              else
              {
                var total_amount_pt = response.transaction_details[i].request_no_of_copies * response.transaction_details[i].amount;
                appendrow2 = "<tr>" +
                                "<td><input type='hidden' name='request_transactions_id[]' value='" + response.transaction_details[i].request_transactions_id + "'>" + response.transaction_details[i].transaction_name + "</td>" +

                                "<td align='right'>Php " + response.transaction_details[i].amount + "</td>" +

                                "<td><input type='hidden' name='qty_of_inputs[]' value='"+response.transaction_details[i].quantity_of_unit+"'></td>" +

                                "<td><input type='hidden' name='no_of_copies[]' value='"+response.transaction_details[i].request_no_of_copies+"'></td>" +

                                "<td align='right'><input type='text' class='form-control text-right amounts' name='total_amount[]' id='total_amount"+ response.transaction_details[i].request_transactions_id +"' value='"+total_amount_pt.toFixed(2)+"' readonly></td>" +
                              "</tr>";
                total_amount += total_amount_pt;
              }
            }
            else if(response.transaction_details[i].transaction_type == "Fixed With Unit")
            {
              if (response.transaction_details[i].category == "Document")
              {
                if(response.transaction_details[i].unit_inputted_by == "Office")
                {
                  appendrow2 = "<tr>" +
                                  "<td><input type='hidden' name='request_transactions_id[]' value='" + response.transaction_details[i].request_transactions_id + "'>" + response.transaction_details[i].transaction_name + "</td>" +

                                  "<td align='right'><input type='hidden' id='current_price"+response.transaction_details[i].request_transactions_id+"' value='"+response.transaction_details[i].amount+"'>Php " + response.transaction_details[i].amount + " " + response.transaction_details[i].unit + "</td>" +

                                  "<td><input type='number' class='form-control qty_of_units text-right' id='qty_of_units"+response.transaction_details[i].request_transactions_id+"' step='0.01' min='0' name='qty_of_inputs[]' required></td>" +

                                  "<td><input type='hidden' name='no_of_copies[]' id='no_of_copies"+response.transaction_details[i].request_transactions_id+"' value='"+response.transaction_details[i].request_no_of_copies+"'>" + response.transaction_details[i].request_no_of_copies + "</td>" +

                                  "<td align='right'><input type='text' class='form-control text-right amounts' name='total_amount[]' id='total_amount"+ response.transaction_details[i].request_transactions_id +"' readonly></td>" +
                                "</tr>";
                }
                else
                {
                  var total_amount_pt = (response.transaction_details[i].amount * response.transaction_details[i].quantity_of_unit) * response.transaction_details[i].request_no_of_copies;
                  appendrow2 = "<tr>" +
                                  "<td><input type='hidden' name='request_transactions_id[]' value='" + response.transaction_details[i].request_transactions_id + "'>" + response.transaction_details[i].transaction_name + "</td>" +

                                  "<td align='right'>Php " + response.transaction_details[i].amount + " " + response.transaction_details[i].unit + "</td>" +

                                  "<td><input type='hidden' name='qty_of_inputs[]' value='"+response.transaction_details[i].quantity_of_unit+"'>" + response.transaction_details[i].quantity_of_unit + "</td>" +

                                  "<td><input type='hidden' name='no_of_copies[]' value='"+response.transaction_details[i].request_no_of_copies+"'>" + response.transaction_details[i].request_no_of_copies + "</td>" +

                                  "<td align='right'><input type='text' class='form-control text-right amounts' name='total_amount[]' id='total_amount"+ response.transaction_details[i].request_transactions_id +"' value='"+total_amount_pt.toFixed(2)+"' readonly></td>" +
                                "</tr>";
                    total_amount += total_amount_pt;
                }
              }
              else
              {
                if(response.transaction_details[i].unit_inputted_by == "Office")
                {
                  appendrow2 = "<tr>" +
                                "<td><input type='hidden' name='request_transactions_id[]' value='" + response.transaction_details[i].request_transactions_id + "'>" + response.transaction_details[i].transaction_name + "</td>" +

                                "<td align='right'><input type='hidden' id='current_price"+response.transaction_details[i].request_transactions_id+"' value='"+response.transaction_details[i].amount+"'>Php " + response.transaction_details[i].amount + " " + response.transaction_details[i].unit + "</td>" +

                                "<td><input type='number' class='form-control qty_of_units text-right' id='qty_of_units"+response.transaction_details[i].request_transactions_id+"' step='0.01' min='0' name='qty_of_inputs[]' required></td>" +

                                "<td><input type='hidden' name='no_of_copies[]' id='no_of_copies"+response.transaction_details[i].request_no_of_copies+"' value='"+response.transaction_details[i].request_no_of_copies+"'></td>" +

                                "<td align='right'><input type='text' class='form-control text-right amounts' name='total_amount[]' id='total_amount"+ response.transaction_details[i].request_transactions_id +"' readonly></td>" +
                              "</tr>";
                }
                else
                {
                  var total_amount_pt = response.transaction_details[i].amount * response.transaction_details[i].quantity_of_unit;
                  appendrow2 = "<tr>" +
                                "<td><input type='hidden' name='request_transactions_id[]' value='" + response.transaction_details[i].request_transactions_id + "'>" + response.transaction_details[i].transaction_name + "</td>" +

                                "<td align='right'>Php " + response.transaction_details[i].amount + " " + response.transaction_details[i].unit + "</td>" +

                                "<td><input type='hidden' name='qty_of_inputs[]' value='"+response.transaction_details[i].quantity_of_unit+"'>" + response.transaction_details[i].quantity_of_unit + "</td>" +

                                "<td><input type='hidden' name='no_of_copies[]' value='"+response.transaction_details[i].request_no_of_copies+"'></td>" +

                                "<td align='right'><input type='text' class='form-control text-right amounts' name='total_amount[]' id='total_amount"+ response.transaction_details[i].request_transactions_id +"' value='"+total_amount_pt.toFixed(2)+"' readonly></td>" +
                              "</tr>";
                    total_amount += total_amount_pt;
                }
              }
            }
            else
            {
              appendrow2 = "<tr>" +
                              "<td><input type='hidden' name='request_transactions_id[]' value='" + response.transaction_details[i].request_transactions_id + "'>" + response.transaction_details[i].transaction_name + "</td>" +

                              "<td align='right'></td>" +

                              "<td><input type='hidden' name='qty_of_inputs[]' value='"+response.transaction_details[i].quantity_of_unit+"'></td>" +

                              "<td><input type='hidden' name='no_of_copies[]' value='"+response.transaction_details[i].request_no_of_copies+"'></td>" +

                              "<td align='right'><input type='number' class='form-control text-right amounts' step='0.01' min='1' name='total_amount[]' required></td>" +
                            "</tr>";
            }
            
            $("#list_of_request").append(appendrow2);
          });

          $("#transaction_details tbody").html(appendrow);
          $("#total_amount_print").html(total_amount.toFixed(2));
        }
      });
     $('#process').modal('show');
  });

  $(document).on('change', '.qty_of_units', function(){
    compute_trigger = 0;
    var id = $(this).attr("id");
    var value = $(this).val();
    var true_id = id.slice(12);
    var current_price = $("#current_price" + true_id).val();
    var no_of_copies = $("#no_of_copies" + true_id).val();
    ta = parseFloat(current_price) * parseFloat(value) * parseFloat(no_of_copies);
    $("#total_amount" + true_id).val(ta.toFixed(2));
  });

  $(document).on('change', '.amounts', function(){
    compute_trigger = 0;
  });

  $("#compute").on('click', function(e)
  {
    compute_trigger = 1;
    console.log(compute_trigger);
    var values = $('.amounts');
    var sum = 0;
    for (var i =0; i<values.length; i++) {
      sum += parseFloat($(values[i]).val());
    }
    $("#total_amount_print").html(sum.toFixed(2));
  });

  $("#form_request_verify").on('submit', function(e) {
    if(compute_trigger = 0)
    {
      event.preventDefault();
    }
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

  $("#transaction_details ").on('keyup', '#quantity', function()
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
        
      }
    }
  });
}
</script>
</body>
</html>