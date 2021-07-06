<?php
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
			      <li class="nav-item"><a href="#" id="checkyourtransaction" class="nav-link"><span>CHECK YOUR TRANSACTION</span></a></li>
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
              <div class='col-md-4 d-flex ftco-animate' id='transactions' style='border: 0px solid black;'>
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
<?php 
  include 'modal.php';
?>

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

<script>
  

  $(function()
  {
    $('.request').on('click', function (e) 
    {
      e.preventDefault();
      var id = $(this).closest("#transactions").find("#account_code").val();
      //var transtype = $(this).closest("#transactions").find("#type").text();
      //var transamount = $(this).closest("#transactions").find("#amount").text();
      //var transoffice = $(this).closest("#transactions").find("#office").text();
      
      $.ajax({
        type: 'POST',
        url: 'transaction_details.php',
        data: {id:id},
        dataType: 'json',
        success: function(response){
          if(response.error)
          {
            alert(response.message);
          }
          else
          {
            var cur_date = new Date();
            var cur_year = cur_date.getFullYear();
            var cur_month = cur_date.getMonth() + 1;
            $("#year").val(cur_year);
            $("#month").val(cur_month);
            $("#transcode").val(response.account_code);
            $("#transtype").val(response.description);
            $("#transamount").val(response.amount);
            $("#transoffice").val(response.office_name);
            $("#transCategory").val(response.category);
            $("#transUnitInputtedBy").val(response.unit_inputted_by);
            $("#transNoOfCopy").val(response.no_of_copy);
          }
        }
      });
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

    $('#client_type').on('change', function (e) 
    {
      $("#secondform").empty();
      $("#additionalTr").empty();
      e.preventDefault();
      var type = $('option:selected',this).val();
      var transCategory = $("#transCategory").val();
      var transUnitInputtedBy = $("#transUnitInputtedBy").val();
      var transNoOfCopy = $("#transNoOfCopy").val();

      if(transCategory == "Document")
      {
        if(type == "External2")
        {
          $("#secondform").append("<div class='form-group'><div class='row'><label for='lastname' class='col-sm-3 control-label'>Lastname:</label><div class='col-sm-9'><input class='form-control' type='text' id='lastname' name='lastname' placeholder='Enter your lastname here' required autocomplete='off'></div></div></div> <div class='form-group'><div class='row'><label for='firstname' class='col-sm-3 control-label'>Firstname:</label><div class='col-sm-9'><input class='form-control' type='text' id='firstname' name='firstname' placeholder='Enter your firstname here' required autocomplete='off'></div></div></div> <div class='form-group'><div class='row'><label for='middlename' class='col-sm-3 control-label'>Middlename:</label><div class='col-sm-9'><input class='form-control' type='text' id='middlename' name='middlename' placeholder='Enter your middlename here' autocomplete='off'></div></div></div> <div class='form-group'><div class='row'><label for='email' class='col-sm-3 control-label'>Email:</label><div class='col-sm-9'><input class='form-control' type='email' id='email' name='email' placeholder='Enter your email here' required autocomplete='off'></div></div></div><div class='form-group'><div class='row'><label for='note' class='col-sm-3 control-label'>Note (optional):</label><div class='col-sm-9'><textarea class='form-control' type='text' id='note' name='note' placeholder='Enter additional notes here' rows='5'></textarea></div></div></div>")
        }
        else if(type == "External1")
        {
          $("#secondform").append("<div class='form-group'><div class='row'><label for='externalno' class='col-sm-3 control-label'>Requestor #:</label><div class='col-sm-9'><input class='form-control' type='text' id='externalno' name='externalno' placeholder='Enter your requestor number here' required></div></div></div> <div class='form-group'><div class='row'><label for='lastname' class='col-sm-3 control-label'>Lastname:</label><div class='col-sm-9'><input class='form-control' type='text' id='lastname' name='lastname' placeholder='Enter your lastname here' required autocomplete='off'></div></div></div> <div class='form-group'><div class='row'><label for='note' class='col-sm-3 control-label'>Note (optional):</label><div class='col-sm-9'><textarea class='form-control' type='text' id='note' name='note' placeholder='Enter additional notes here' rows='5'></textarea></div></div></div>")
        }
        else if(type == "Student")
        {
          if(transNoOfCopy == "YES")
          {
            $("#secondform").append("<div class='form-group'><div class='row'><label for='studno' class='col-sm-3 control-label'>Student #:</label><div class='col-sm-9'><input class='form-control' type='text' id='studno' name='studno' placeholder='Enter your student number here' required></div></div></div> <div class='form-group'><div class='row'><label for='lname' class='col-sm-3 control-label'>Last Name:</label><div class='col-sm-9'><input class='form-control' type='text' id='lname' name='lname' placeholder='Enter your lastname here' required></div></div></div> <div class='form-group'><div class='row'><label for='email' class='col-sm-3 control-label'>Email:</label><div class='col-sm-9'><input class='form-control' type='email' id='email' name='email' placeholder='Enter your email here' required></div></div></div> <div class='form-group'><div class='row'><div class='col-sm-3'></div><div class='col-sm-9'><div class='form-check'><input class='form-check-input' type='checkbox' value='' id='use_pnu_email'><label class='form-check-label' for='use_pnu_email'>Use PNU Email Instead</label></div></div></div></div> <div class='form-group'><div class='row'><label for='no_of_copies' class='col-sm-3 control-label'>No. Of Copy(ies):</label><div class='col-sm-9'><input class='form-control' type='number' min='1' id='no_of_copies' name='no_of_copies' placeholder='Enter number of copy(ies) here' required></div></div></div> <div class='form-group'><div class='row'><label for='note' class='col-sm-3 control-label'>Note (optional):</label><div class='col-sm-9'><textarea class='form-control' type='text' id='note' name='note' placeholder='Enter additional notes here' rows='5'></textarea></div></div></div>");

            $("#confirmationTable").find('tbody').append("<tr><td>No. Of Copies</td><td><span id='confModal_noOfCopies'></span></td></tr>");
          }
          else
          {
            $("#secondform").append("<div class='form-group'><div class='row'><label for='studno' class='col-sm-3 control-label'>Student #:</label><div class='col-sm-9'><input class='form-control' type='text' id='studno' name='studno' placeholder='Enter your student number here' required></div></div></div> <div class='form-group'><div class='row'><label for='lname' class='col-sm-3 control-label'>Last Name:</label><div class='col-sm-9'><input class='form-control' type='text' id='lname' name='lname' placeholder='Enter your lastname here' required></div></div></div> <div class='form-group'><div class='row'><label for='email' class='col-sm-3 control-label'>Email:</label><div class='col-sm-9'><input class='form-control' type='email' id='email' name='email' placeholder='Enter your email here' required></div></div></div> <div class='form-group'><div class='row'><div class='col-sm-3'></div><div class='col-sm-9'><div class='form-check'><input class='form-check-input' type='checkbox' value='' id='use_pnu_email'><label class='form-check-label' for='use_pnu_email'>Use PNU Email Instead</label></div></div></div></div> <div class='form-group'><div class='row'><label for='note' class='col-sm-3 control-label'>Note (optional):</label><div class='col-sm-9'><textarea class='form-control' type='text' id='note' name='note' placeholder='Enter additional notes here' rows='5'></textarea></div></div></div>");
          }
        }
        else
        {
          $("#secondform").append("<div class='form-group'><div class='row'><label for='applicantno' class='col-sm-3 control-label'>Applicant #:</label><div class='col-sm-9'><input class='form-control' type='text' id='applicantno' name='applicantno' placeholder='Enter your applicant number here' required></div></div></div> <div class='form-group'><div class='row'><label for='lname' class='col-sm-3 control-label'>Last Name:</label><div class='col-sm-9'><input class='form-control' type='text' id='lname' name='lname' placeholder='Enter your lastname here' required></div></div></div> <div class='form-group'><div class='row'><label for='email' class='col-sm-3 control-label'>Email:</label><div class='col-sm-9'><input class='form-control' type='email' id='email' name='email' placeholder='Enter your email here' required></div></div></div> <div class='form-group'><div class='row'><label for='note' class='col-sm-3 control-label'>Note (optional):</label><div class='col-sm-9'><textarea class='form-control' type='text' id='note' name='note' placeholder='Enter additional notes here' rows='5'></textarea></div></div></div>")
        }
      }
      else
      {
        if(type == "External2")
        {
          $("#secondform").append("<div class='form-group'><div class='row'><label for='lastname' class='col-sm-3 control-label'>Lastname:</label><div class='col-sm-9'><input class='form-control' type='text' id='lastname' name='lastname' placeholder='Enter your lastname here' required autocomplete='off'></div></div></div> <div class='form-group'><div class='row'><label for='firstname' class='col-sm-3 control-label'>Firstname:</label><div class='col-sm-9'><input class='form-control' type='text' id='firstname' name='firstname' placeholder='Enter your firstname here' required autocomplete='off'></div></div></div> <div class='form-group'><div class='row'><label for='middlename' class='col-sm-3 control-label'>Middlename:</label><div class='col-sm-9'><input class='form-control' type='text' id='middlename' name='middlename' placeholder='Enter your middlename here' autocomplete='off'></div></div></div> <div class='form-group'><div class='row'><label for='email' class='col-sm-3 control-label'>Email:</label><div class='col-sm-9'><input class='form-control' type='email' id='email' name='email' placeholder='Enter your email here' required autocomplete='off'></div></div></div><div class='form-group'><div class='row'><label for='note' class='col-sm-3 control-label'>Note (optional):</label><div class='col-sm-9'><textarea class='form-control' type='text' id='note' name='note' placeholder='Enter additional notes here' rows='5'></textarea></div></div></div>")
        }
        else if(type == "External1")
        {
          $("#secondform").append("<div class='form-group'><div class='row'><label for='externalno' class='col-sm-3 control-label'>Requestor #:</label><div class='col-sm-9'><input class='form-control' type='text' id='externalno' name='externalno' placeholder='Enter your requestor number here' required></div></div></div> <div class='form-group'><div class='row'><label for='lastname' class='col-sm-3 control-label'>Lastname:</label><div class='col-sm-9'><input class='form-control' type='text' id='lastname' name='lastname' placeholder='Enter your lastname here' required autocomplete='off'></div></div></div> <div class='form-group'><div class='row'><label for='note' class='col-sm-3 control-label'>Note (optional):</label><div class='col-sm-9'><textarea class='form-control' type='text' id='note' name='note' placeholder='Enter additional notes here' rows='5'></textarea></div></div></div>")
        }
        else if(type == "Student")
        {
          if(transUnitInputtedBy == "Client")
          {
            $("#secondform").append("<div class='form-group'><div class='row'><label for='studno' class='col-sm-3 control-label'>Student #:</label><div class='col-sm-9'><input class='form-control' type='text' id='studno' name='studno' placeholder='Enter your student number here' required></div></div></div> <div class='form-group'><div class='row'><label for='lname' class='col-sm-3 control-label'>Last Name:</label><div class='col-sm-9'><input class='form-control' type='text' id='lname' name='lname' placeholder='Enter your lastname here' required></div></div></div> <div class='form-group'><div class='row'><label for='email' class='col-sm-3 control-label'>Email:</label><div class='col-sm-9'><input class='form-control' type='email' id='email' name='email' placeholder='Enter your email here' required></div></div></div> <div class='form-group'><div class='row'><div class='col-sm-3'></div><div class='col-sm-9'><div class='form-check'><input class='form-check-input' type='checkbox' value='' id='use_pnu_email'><label class='form-check-label' for='use_pnu_email'>Use PNU Email Instead</label></div></div></div></div> <div class='form-group'><div class='row'><label for='qty_of_unit' class='col-sm-3 control-label'>Quantity (based on unit):</label><div class='col-sm-9'><input class='form-control' type='number' id='qty_of_unit' name='qty_of_unit' placeholder='Enter quantity here' required></div></div></div> <div class='form-group'><div class='row'><label for='note' class='col-sm-3 control-label'>Note (optional):</label><div class='col-sm-9'><textarea class='form-control' type='text' id='note' name='note' placeholder='Enter additional notes here' rows='5'></textarea></div></div></div>");
          }
          else
          {
            $("#secondform").append("<div class='form-group'><div class='row'><label for='studno' class='col-sm-3 control-label'>Student #:</label><div class='col-sm-9'><input class='form-control' type='text' id='studno' name='studno' placeholder='Enter your student number here' required></div></div></div> <div class='form-group'><div class='row'><label for='lname' class='col-sm-3 control-label'>Last Name:</label><div class='col-sm-9'><input class='form-control' type='text' id='lname' name='lname' placeholder='Enter your lastname here' required></div></div></div> <div class='form-group'><div class='row'><label for='email' class='col-sm-3 control-label'>Email:</label><div class='col-sm-9'><input class='form-control' type='email' id='email' name='email' placeholder='Enter your email here' required></div></div></div> <div class='form-group'><div class='row'><div class='col-sm-3'></div><div class='col-sm-9'><div class='form-check'><input class='form-check-input' type='checkbox' value='' id='use_pnu_email'><label class='form-check-label' for='use_pnu_email'>Use PNU Email Instead</label></div></div></div></div> <div class='form-group'><div class='row'><label for='note' class='col-sm-3 control-label'>Note (optional):</label><div class='col-sm-9'><textarea class='form-control' type='text' id='note' name='note' placeholder='Enter additional notes here' rows='5'></textarea></div></div></div>");
          }
        }
        else
        {
          $("#secondform").append("<div class='form-group'><div class='row'><label for='applicantno' class='col-sm-3 control-label'>Applicant #:</label><div class='col-sm-9'><input class='form-control' type='text' id='applicantno' name='applicantno' placeholder='Enter your applicant number here' required></div></div></div> <div class='form-group'><div class='row'><label for='lname' class='col-sm-3 control-label'>Last Name:</label><div class='col-sm-9'><input class='form-control' type='text' id='lname' name='lname' placeholder='Enter your lastname here' required></div></div></div> <div class='form-group'><div class='row'><label for='email' class='col-sm-3 control-label'>Email:</label><div class='col-sm-9'><input class='form-control' type='email' id='email' name='email' placeholder='Enter your email here' required></div></div></div> <div class='form-group'><div class='row'><label for='note' class='col-sm-3 control-label'>Note (optional):</label><div class='col-sm-9'><textarea class='form-control' type='text' id='note' name='note' placeholder='Enter additional notes here' rows='5'></textarea></div></div></div>")
        }
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

    $(document).on('click', '#use_pnu_email', function (e) {
      if($("#use_pnu_email").is(':checked'))
      {
        $("#email").attr("readonly", "true");
        $("#email").attr("placeholder", "Your PNU Email will be automatically loaded!");
      }
      else
      {
        $("#email").removeAttr("readonly");
        $("#email").attr("placeholder", "Enter your email here");
      }
          
    });
  });
</script>