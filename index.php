<?php
  include 'admin_module/client/includes/session.php';
  include 'admin_module/admin/includes/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Transaction Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">
    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    
  </head>
  <body>
	  
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="#" data-nav-section="home"><span>PNU - MANILA</span></a>
	      <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav nav ml-auto">
	          <li class="nav-item"><a href="#" class="nav-link" data-nav-section="portal"><span>REQUEST TRANSACTIONS</span></a></li>
			      <li class="nav-item"><a href="#" id="checkyourtransaction" class="nav-link"><span>TRANSACTION HISTORY</span></a></li>
            <li class="nav-item"><a href="#" id="logout" class="nav-link"><span>LOGOUT</span></a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    
    <section class="hero-wrap js-fullheight" style="background-image: url('images/PNU.png');" data-section="home">
      <div class="overlay"></div>
	  <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate mt-5" data-scrollax=" properties: { translateY: '70%' }">
            <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Welcome to Philippine Normal University E-Services Portal!</h1>
            <p class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"></p>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section bg-light" data-section="portal" style="padding: 2em;">
		<div class="container">
		  <div class="row justify-content-center">
			<div class="col-md-7 heading-section text-center ftco-animate">
			  <span class="subheading">Transactions List</span>
			</div>
		  </div>
		  <div class="row justify-content-right">
			<div class="col-md-2 ftco-animate">
			</div>
      <div class="col-md-4 ftco-animate">
				<div class="sidebar-box" style="margin-bottom: 0;padding:0;">
					<form class="search-form" style="background-color:#f8f9fa;">
						<div class="form-group">
						<select class="form-control" id="office_filter">
              <option selected hidden disabled>-- Filter by Office --</option>
              <option value="ALL">ALL</option>
              <?php
                $sql = "SELECT * FROM tbl_offices WHERE remarks = 'active'";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc())
                {
                  $office_id = $row["id"];
                  $office_name = $row["description"];

                  echo "<option value='$office_id'>$office_name</option>";
                }
              ?>
            </select>
						</div>
					</form>
				</div>
			</div>
      <div class="col-md-4 ftco-animate">
				<div class="sidebar-box" style="margin-bottom: 0;padding:0;">
					<form class="search-form" style="background-color:#f8f9fa;">
						<div class="form-group">
						<span class="icon icon-search"></span>
						<input type="text" id="transactionkey" class="form-control" placeholder="Type keyword for transaction">
						</div>
					</form>
				</div>
			</div>
      <div class="col-md-2 ftco-animate">
        <div class="sidebar-box" style="margin-bottom: 0;padding:0;">
          <form class="search-form" style="background-color:#f8f9fa;">
						<div class="form-group">
						<span class="icon "></span>
						<a type="button" href="javascript:void(0);" id="searchtransaction" class="form-control btn btn-primary">SEARCH</a>
						</div>
					</form>
        </div>
			</div>
		  </div>
		  <div class="row d-flex" id="transactionlist">
      <?php
        $sql = "SELECT a.*, b.description as office_name FROM tbl_transactions a LEFT JOIN tbl_offices b ON a.office_id = b.id WHERE a.remarks = 'active' LIMIT 6";
        $query = $conn->query($sql);
        while($row = $query->fetch_assoc())
        {
            $account_code = $row["account_code"];
            $description = $row["description"];
            $office_name = $row["office_name"];
            $amount = number_format($row["amount"], 2);
            $unit = $row["unit"];
            echo "
              <div class='col-md-6 d-flex ftco-animate' id='transactions' style='border: 0px solid black;'>
                <div class='blog-entry justify-content-end'>
                <div class='text mt-3 float-right'>
                  <input type='hidden' id='account_code' value='$account_code'>
                  <h3 id='type' class='heading'>$description</h3>";
            if(strlen($description) <= 27)
            {
              echo "<br>";
            }
            echo "
                  <p id='office'>Office: $office_name</p>";
            if(!empty($amount) && !empty($unit))
            {
              echo "<p id='amount'>Amount: P $amount $unit</p>";
            }
            else if($amount > 0 && empty($unit))
            {
              echo "<p id='amount'>Amount: P $amount</p>";
            }
            else
            {
              echo "<p id='amount'>Amount: To be decided</p>";
            }
            echo"
                  
                  <div class='d-flex align-items-center mt-4 meta'>
                    <p class='mb-0'><a href='#carouselModal' data-toggle='modal' class='btn btn-secondary request'>Request this transaction <span class='ion-ios-arrow-round-forward'></span></a></p>
                  </div>
                </div>
                </div>
              </div>
            ";
        }
      ?>

			
		  </div><!-- end of row -->
		</div>
	  </section>
		
    <footer class="ftco-footer" style="padding: 2em;">
      <div class="container">
        </div>
		<div class="row">
			<div class="col-md-12 text-center">
			<p>
        Created by Management Information System Office
			</p>
			</div>
		  </div>
      </div>
      </footer>
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="js/main.js"></script>

  </body>
</html>
<!-- Datatables -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<?php 
  include 'modal.php';
?>

<script>
  var unit;
  var map = new Map();

  $(function()
  {
    $('.request').on('click', function (e) 
    {
      e.preventDefault();
      $("#secondform").empty();
      $("#client_type").val("");
      $("#additionalTr").empty();
      var id = $(this).closest("#transactions").find("#account_code").val();
      
      $.ajax({
        type: 'POST',
        url: 'transaction_details.php',
        data: {id:id},
        async: false,
        dataType: 'json',
        success: function(response){
          if(response.error)
          {
            alert(response.message);
          }
          else
          {
            // If table is initialized
            if ($.fn.DataTable.isDataTable('#example2')){
              // Destroy existing table
              $('#example2').DataTable().destroy();
            };

            var cur_date = new Date();
            var cur_year = cur_date.getFullYear();
            var cur_month = cur_date.getMonth() + 1;
            $("#year").val(cur_year);
            $("#month").val(cur_month);
            $("#transactionList").empty();
            $("#unitPrice").empty();
            if(response.transaction.transaction_type == "Fixed With Unit")
            {
              $("#unitPrice").html("("+response.transaction.unit+")");
              if (response.transaction.category == "Document")
              {
                if(response.transaction.no_of_copy == "YES")
                {
                  var appendrow = "<tr id='" + response.transaction.account_code + "'>" +
                                    "<td>" + response.transaction.description + "</td>" +
                                    "<td>" + response.transaction.office_name + "</td>" +
                                    "<td>" + response.transaction.note + "</td>" +
                                    "<td>Php " + response.transaction.amount + " " +  response.transaction.unit + "</td>" +
                                    "<td>To be decided by Office</td>" +
                                    "<td><input type='number' class='form-control' name='no_copies' min='1' required></td>" +
                                    "<td>Will be indicated in Order of Payment</td>" +
                                    "<td></td>" +
                                  "</tr>";
                }
                else
                {
                  var appendrow = "<tr id='" + response.transaction.account_code + "'>" +
                                    "<td>" + response.transaction.description + "</td>" +
                                    "<td>" + response.transaction.office_name + "</td>" +
                                    "<td>" + response.transaction.note + "</td>" +
                                    "<td>Php " + response.transaction.amount + " " +  response.transaction.unit + "</td>" +
                                    "<td>To be decided by Office</td>" +
                                    "<td>1</td>" +
                                    "<td></td>" +
                                    "<td></td>" +
                                  "</tr>";
                }
              }
              else
              {
                if(response.transaction.unit_inputted_by == "Client")
                {
                  var appendrow = "<tr id='" + response.transaction.account_code + "'>" +
                                    "<td>" + response.transaction.description + "</td>" +
                                    "<td>" + response.transaction.office_name + "</td>" +
                                    "<td>" + response.transaction.note + "</td>" +
                                    "<td>Php " + response.transaction.amount + " " +  response.transaction.unit + "</td>" +
                                    "<td><input type='number' class='form-control' name='qty_of_unit' min='1' required></td>" +
                                    "<td>-</td>" +
                                    "<td>Will be indicated in Order of Payment</td>" +
                                    "<td></td>" +
                                  "</tr>";
                }
                else
                {
                  var appendrow = "<tr id='" + response.transaction.account_code + "'>" +
                                    "<td>" + response.transaction.description + "</td>" +
                                    "<td>" + response.transaction.office_name + "</td>" +
                                    "<td>" + response.transaction.note + "</td>" +
                                    "<td>Php " + response.transaction.amount + " " +  response.transaction.unit + "</td>" +
                                    "<td>To be decided by Office</td>" +
                                    "<td>-</td>" +
                                    "<td>Will be indicated in Order of Payment</td>" +
                                    "<td></td>" +
                                  "</tr>";
                }
              }
            }
            else if(response.transaction.transaction_type == "Fixed")
            {
              if (response.transaction.category == "Document")
              {
                if(response.transaction.no_of_copy == "YES")
                {
                  var appendrow = "<tr id='" + response.transaction.account_code + "'>" +
                                    "<td>" + response.transaction.description + "</td>" +
                                    "<td>" + response.transaction.office_name + "</td>" +
                                    "<td>" + response.transaction.note + "</td>" +
                                    "<td>Php " + response.transaction.amount + "</td>" +
                                    "<td>-</td>" +
                                    "<td><input type='number' class='form-control' name='no_copies' min='1' required></td>" +
                                    "<td><span id='totalPrice'></span></td>" +
                                    "<td></td>" +
                                  "</tr>";
                }
                else
                {
                  var appendrow = "<tr id='" + response.transaction.account_code + "'>" +
                                    "<td>" + response.transaction.description + "</td>" +
                                    "<td>" + response.transaction.office_name + "</td>" +
                                    "<td>" + response.transaction.note + "</td>" +
                                    "<td>Php " + response.transaction.amount + "</td>" +
                                    "<td>-</td>" +
                                    "<td>1</td>" +
                                    "<td>Php " + response.transaction.amount + "</td>" +
                                    "<td></td>" +
                                  "</tr>";
                }
              }
              else
              {
                var appendrow = "<tr id='" + response.transaction.account_code + "'>" +
                                  "<td>" + response.transaction.description + "</td>" +
                                  "<td>" + response.transaction.office_name + "</td>" +
                                  "<td>" + response.transaction.note + "</td>" +
                                  "<td>Php " + response.transaction.amount + "</td>" +
                                  "<td>-</td>" +
                                  "<td>-</td>" +
                                  "<td>Php " + response.transaction.amount + "</td>" +
                                  "<td></td>" +
                                "</tr>";
              }
            }
            else
            {
              if (response.transaction.category == "Document")
              {
                if(response.transaction.no_of_copy == "YES")
                {
                  var appendrow = "<tr id='" + response.transaction.account_code + "'>" +
                                    "<td>" + response.transaction.description + "</td>" +
                                    "<td>" + response.transaction.office_name + "</td>" +
                                    "<td>" + response.transaction.note + "</td>" +
                                    "<td>Will be indicated in Order of Payment</td>" +
                                    "<td>-</td>" +
                                    "<td><input type='number' class='form-control' name='no_copies' min='1' required></td>" +
                                    "<td>Will be indicated in Order of Payment</span></td>" +
                                    "<td></td>" +
                                  "</tr>";
                }
                else
                {
                  var appendrow = "<tr id='" + response.transaction.account_code + "'>" +
                                    "<td>" + response.transaction.description + "</td>" +
                                    "<td>" + response.transaction.office_name + "</td>" +
                                    "<td>" + response.transaction.note + "</td>" +
                                    "<td>Will be indicated in Order of Payment</td>" +
                                    "<td>-</td>" +
                                    "<td>-</td>" +
                                    "<td>Will be indicated in Order of Payment</td>" +
                                    "<td></td>" +
                                  "</tr>";
                }
              }
              else
              {
                var appendrow = "<tr id='" + response.transaction.account_code + "'>" +
                                    "<td>" + response.transaction.description + "</td>" +
                                    "<td>" + response.transaction.office_name + "</td>" +
                                    "<td>" + response.transaction.note + "</td>" +
                                    "<td>Will be indicated in Order of Payment</td>" +
                                    "<td>-</td>" +
                                    "<td>-</td>" +
                                    "<td>Will be indicated in Order of Payment</td>" +
                                    "<td></td>" +
                                  "</tr>";
              }
            }
            $("#transactionList").append(appendrow);

            $("#loadedTransactions").empty();
            
            var appendrow2 = "";
            if($.trim(response.loadedTransaction))
            {
              $.each(response.loadedTransaction, function(i, item)
              {
                appendrow2 = "<tr id='" + response.loadedTransaction[i].account_code + "'>" +
                                  "<td>" + response.loadedTransaction[i].description + "</td>" +
                                  "<td>" + response.loadedTransaction[i].office_name + "</td>" +
                                  "<td>" + response.loadedTransaction[i].note + "</td>" +
                                  "<td>Will be indicated in Order of Payment</td>" +
                                  "<td><button type='button' class='btn btn-primary add' name='add'>ADD</button></td>" +
                                "</tr>";
                $("#loadedTransactions").append(appendrow2);
              });

              $('#example2').DataTable();
            }
            else
            {
              $('#example2').DataTable().draw();
            }

            /* $("#transcode").val(response.account_code);
            $("#transtype").val(response.description);
            if(response.transaction_type == "Fixed With Unit")
            {
              $("#transamount").val(response.amount + " " + response.unit);
            }
            else
            {
              $("#transamount").val(response.amount);
            }
            unit = response.unit;
            $("#transoffice").val(response.office_name);
            $("#transCategory").val(response.category);
            $("#transUnitInputtedBy").val(response.unit_inputted_by);
            $("#transNoOfCopy").val(response.no_of_copy); */
          }
        }
      });
    });

    $('#logout').on('click', function (e) 
    {
      window.location.replace("admin_module/client/logout.php");
    });

    $('#checkyourtransaction').on('click', function (e) 
    {
      e.preventDefault();
      $('#checkTransaction').modal('show');
    });

    $('#searchtransaction').on('click', function (e) 
    {
      e.preventDefault();
      var keyword = $("#transactionkey").val();
      if(keyword != "")
      {
        $.get("searchtrans.php?keyword=" + keyword, function( data ) 
        {
            $("#transactionlist").html(data);
        });
      }
      else
      {
        location.reload();
      }
    });

    $('#office_filter').on('change', function (e) 
    {
      var office_id = $(this).val();

      if(office_id == "ALL")
      {
        location.reload();
      }
      else
      {
        $.get("office_filter.php?office_id=" + office_id, function( data ) 
        {
            $("#transactionlist").html(data);
        });
      }

    });

    $('#cyt_client_type').on('change', function (e) 
    {
      $("#cyt_secondform").empty();
      e.preventDefault();
      var type = $('option:selected',this).val();
      if(type == "External")
      {
        $("#cyt_secondform").append("<div class='form-group'><div class='row'><label for='externalno' class='col-sm-3 control-label'>Requestor #:</label><div class='col-sm-9'><input class='form-control' type='text' id='externalno' name='externalno' placeholder='Enter your requestor number here' required></div></div></div> <div class='form-group'><div class='row'><label for='lastname' class='col-sm-3 control-label'>Lastname:</label><div class='col-sm-9'><input class='form-control' type='text' id='lastname' name='lastname' placeholder='Enter your lastname here' required autocomplete='off'></div></div></div>")
      }
      else if(type == "Student")
      {
        $("#cyt_secondform").append("<div class='form-group'><div class='row'><label for='studno' class='col-sm-3 control-label'>Student #:</label><div class='col-sm-9'><input class='form-control' type='text' id='studno' name='studno' placeholder='Enter your student number here' required></div></div></div> <div class='form-group'><div class='row'><label for='lname' class='col-sm-3 control-label'>Last Name:</label><div class='col-sm-9'><input class='form-control' type='text' id='lname' name='lname' placeholder='Enter your lastname here' required></div></div></div>")
      }
      else
      {
        $("#cyt_secondform").append("<div class='form-group'><div class='row'><label for='applicantno' class='col-sm-3 control-label'>Applicant #:</label><div class='col-sm-9'><input class='form-control' type='text' id='applicantno' name='applicantno' placeholder='Enter your applicant number here' required></div></div></div> <div class='form-group'><div class='row'><label for='lname' class='col-sm-3 control-label'>Last Name:</label><div class='col-sm-9'><input class='form-control' type='text' id='lname' name='lname' placeholder='Enter your lastname here' required></div></div></div>")
      }
    });

    $("#showConfirmation").on('click', function(e){

      $('#carouselModal').modal('hide');

      setTimeout(function() {
            //your code to be executed after 200 msecond 
            $("#confModal_transaction").html($("#transtype").val());
            $("#confModal_transAmount").html($("#transamount").val());
            $("#confModal_transOffice").html($("#transoffice").val());
            $("#confModal_clientType").html($("#client_type").val());
            $("#confModal_studentNumber").html($("#studno").val());
            $("#confModal_lastname").html($("#lname").val());
            $("#confModal_email").html($("#email").val());
            $("#confModal_notes").html($("#note").val());

            $('#confirmationModal').modal({
                backdrop: 'static'//to disable click close
        })
      }, 400);//delay in miliseconds##1000=1second

    });

    $("#backConfirmation").on('click', function(e){

      $('#confirmationModal').modal('hide');

      setTimeout(function() {
            //your code to be executed after 200 msecond 
            $('#carouselModal').modal({
                backdrop: 'static'//to disable click close
        })
      }, 400);//delay in miliseconds##1000=1second

    });

    $("#proceedButton").on('click', function(e)
    {
      map.clear();
      if($("#client_type")[0].checkValidity())
      {
        if($("#transactionForm")[0].checkValidity())
        {
          if($("#transCategory").val() == "Document")
          {
            if($("#client_type").val() == "Student")
            {
              if($("#use_pnu_email").is(':checked'))
              {
                $("#transactionForm input[type=text], #transactionForm #transcode, #transactionForm input[type=email], #transactionFrom input[type=number], #transactionForm textarea, #transactionForm select").each(function()
                {
                  map.set($(this).attr("id"), $(this).val());
                });
                //console.log(map);
                // let keys = Array.from(map.keys());
                // for(let i = 0; i < keys.length; i++){
                //   alert(keys[i]);
                // }

                let values = Array.from(map.values());
                for(let i = 0; i < values.length; i++){
                  alert(values[i]);
                }
              }
            }
          }
        }
        else
        {
          $("#transactionForm")[0].reportValidity();
        }
      }
      else
      {
        $("#client_type")[0].reportValidity()
      }
    });

    $(document).on('click', '#use_pnu_email', function (e) {
      if($("#use_pnu_email").is(':checked'))
      {
        $("#email").attr("readonly", "true");
        $("#email").attr("value", "Use PNU Email instead");
      }
      else
      {
        $("#email").removeAttr("readonly");
        $("#email").removeAttr("value");
      }
          
    });
  });
</script>