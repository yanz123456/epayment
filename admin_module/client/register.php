<?php include 'includes/header.php'; ?>
<style>
  body
  {
    background: url(../../images/pnu.png) no-repeat center center fixed !important;
   -webkit-background-size: cover !important;
   -moz-background-size: cover !important;
   -o-background-size: cover !important;
   background-size: cover !important; 
  }
  * {
		margin: 0;
		padding: 0
	}
	
	html {
		height: 100%
	}

	p {
		color: grey
	}

	#heading {
		text-transform: uppercase;
		font-weight: normal
	}

	#msform {
		text-align: center;
		position: relative;
		margin-top: 20px
	}

	#msform fieldset {
		background: white;
		border: 0 none;
		border-radius: 0.5rem;
		box-sizing: border-box;
		width: 100%;
		margin: 0;
		padding-bottom: 20px;
		position: relative
	}

	.form-card {
		text-align: left
	}

	#msform fieldset:not(:first-of-type) {
		display: none
	}

	#msform .action-button {
		width: 100px;
		background: #26458e;
		font-weight: bold;
		color: white;
		border: 0 none;
		border-radius: 0px;
		cursor: pointer;
		padding: 10px 5px;
		margin: 10px 0px 10px 5px;
		float: right
	}

	#msform .action-button:hover,
	#msform .action-button:focus {
		background-color: #311B92
	}

	#msform .action-button-previous {
		width: 100px;
		background: #616161;
		font-weight: bold;
		color: white;
		border: 0 none;
		border-radius: 0px;
		cursor: pointer;
		padding: 10px 5px;
		margin: 10px 5px 10px 0px;
		float: right
	}

	#msform .action-button-previous:hover,
	#msform .action-button-previous:focus {
		background-color: #000000
	}

	.card {
		z-index: 0;
		border: none;
		position: relative
	}

	.fs-title {
		font-size: 25px;
		color: #26458e;
		margin-bottom: 15px;
		font-weight: normal;
		text-align: left
	}

	.purple-text {
		color: #26458e;
		font-weight: normal
	}

	.steps {
		font-size: 25px;
		color: gray;
		margin-bottom: 10px;
		font-weight: normal;
		text-align: right
	}

	.fieldlabels {
		color: gray;
		text-align: left
	}

	#progressbar {
		margin-bottom: 30px;
		overflow: hidden;
		color: lightgrey
	}

	#progressbar .active {
		color: #26458e
	}

	#progressbar li {
		list-style-type: none;
		font-size: 15px;
		width: 33.2%;
		float: left;
		position: relative;
		font-weight: 400
	}

	#progressbar #account:before {
		font-family: FontAwesome;
		content: "\f13e"
	}

	#progressbar #personal:before {
		font-family: FontAwesome;
		content: "\f007"
	}

	#progressbar #confirm:before {
		font-family: FontAwesome;
		content: "\f00c"
	}

	#progressbar li:before {
		width: 50px;
		height: 50px;
		line-height: 45px;
		display: block;
		font-size: 20px;
		color: #ffffff;
		background: lightgray;
		border-radius: 50%;
		margin: 0 auto 10px auto;
		padding: 2px
	}

	#progressbar li:after {
		content: '';
		width: 100%;
		height: 2px;
		background: lightgray;
		position: absolute;
		left: 0;
		top: 25px;
		z-index: -1
	}

	#progressbar li.active:before,
	#progressbar li.active:after {
		background: #26458e
	}

	.progress {
		height: 20px
	}

	.progress-bar {
		background-color: #26458e
	}

	.fit-image {
		width: 100%;
		object-fit: cover
	}

	.login-box, .register-box
	{
		width: 850px !important;
	}
</style>
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
  		<center><a href="javascript:void(0);"> <img src="../../images/logo_pnu-01.png" style="height: 140px; width: 120px; margin-top: -4px;"></a></center>
  	</div>

	<?php
  		if(isset($_SESSION['success'])){
  			echo "
  				<div class='callout callout-success text-center mt20'>
			  		<p>".$_SESSION['success']."</p> 
			  	</div>
  			";
  			unset($_SESSION['success']);
  		}
	?>
  
  	<div class="login-box-body">
			<div class="container-fluid">
				<div class="row justify-content-center">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-5 text-center p-0 mt-3 mb-2">
						<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
							<h2 id="heading">PNU E-Services Portal Registration Form</h2>
							<p>Fill all form field to go to next step<br><i style="color:red">Please double check your information while filling up!</i></p>
							<form id="accountInfoForm" action="/post/dispatch/save" method="post"></form>
							<form id="personalInfoForm" action="/post/dispatch/save" method="post"></form>
							<form id="msform" method="POST" action="#">
								<!-- progressbar -->
								<ul id="progressbar">
									<li class="active" id="account"><strong>Account</strong></li>
									<li id="personal"><strong>Personal</strong></li>
									<li id="confirm"><strong>Finish</strong></li>
								</ul>
								<div class="progress">
									<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
								</div> <br> <!-- fieldsets -->
								<fieldset id="accountInformation">
									<div class="form-card">
										<div class="row">
											<div class="col-7">
												<h2 class="fs-title">Account Information:</h2>
											</div>
											<div class="col-5">
												<h2 class="steps">Step 1 - 3</h2>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<label class="fieldlabels">Client Type: *</label> 
												<select id="client_type" class="form-control" form="accountInfoForm" name="client_type" required>
													<option value="" disabled hidden selected>-- Select Client Type --</option>
													<option value="Student">Student</option>
													<option value="Applicant">Applicant</option>
													<option value="External">External</option>
												</select>
											</div>
											<div id="account_inputs">
											</div>
										</div>
									</div>
									<input type="button" name="next" class="next action-button" value="Next" required/>
								</fieldset>
								<fieldset id="personalInformation">
									<div class="form-card">
										<div class="row">
											<div class="col-7">
												<h2 class="fs-title">Personal Information:</h2>
											</div>
											<div class="col-5">
												<h2 class="steps">Step 2 - 3</h2>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6">
												<label class="fieldlabels">First Name: *</label> 
												<input type="text" id="firstname" name="firstname" class="form-control" placeholder="First Name" form="personalInfoForm" required/>
											</div>
											<div class="col-lg-6">
												<label class="fieldlabels">Middle Name:</label> 
												<input type="text" id="middlename" name="middlename" class="form-control" placeholder="Middle Name" form="personalInfoForm"/>
											</div>
											<div class="col-lg-6">
												<label class="fieldlabels">Last Name:</label> 
												<input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" form="personalInfoForm"/>
											</div>
											<div class="form-group">
												<div class="col-lg-6">
													<label class="fieldlabels">Date of Birth:</label>
													<div class='date'>
														<input type='text' class='form-control' id='dob' name='dob'>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<label class="fieldlabels">For MARRIED WOMEN: Your maiden name when you studied in PNU</label> 
												<input type="text" id="maiden_name" name="maiden_name" class="form-control" placeholder="Maiden Name" form="personalInfoForm"/>
											</div>
										</div>
									</div> 
									<input type="button" name="next" class="next action-button" value="Next"/>
									<input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
								</fieldset>
								<fieldset id="finish">
									<div class="form-card">
										<div class="row">
											<div class="col-7">
												<h2 class="fs-title">Finish:</h2>
											</div>
											<div class="col-5">
												<h2 class="steps">Step 3 - 3</h2>
											</div>
										</div> <br><br>
										<h1 class="purple-text text-center"><strong>SUCCESS !</strong></h1> <br>
										<div class="row justify-content-center">
											<div class="col-7 text-center">
												<h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
											</div>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
  	</div>
  	<?php
  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>

<script>
$(document).ready(function(){

	var current_fs, next_fs, previous_fs; //fieldsets
	var opacity;
	var current = 1;
	var steps = $("fieldset").length;

	setProgressBar(current);

	$("#client_type").on("change", function()
	{
		if($(this).val() == "Student")
		{
			$("#account_inputs").empty();
			var account_inputs = "<div class='col-lg-12'>" +
								 	"<div class='col-3'><label class='fieldlabels'>Student Number: *</label></div>" +
								 	"<div class='col-9'><input class='form-control' type='text' id='studNo' form='accountInfoForm' name='studNo' placeholder='Student Number' autocomplete='off' required/></div>" +
								 "</div>" +
								 "<div class='col-lg-12'>" +
								 	"<div class='col-3'><label class='fieldlabels'>Lastname: *</label></div>" +
								 	"<div class='col-9'><input class='form-control' type='text' id='lastname' form='accountInfoForm' name='lastname' placeholder='Lastname' autocomplete='off' required/></div>" +
								 "</div>" +
								 "<div class='col-lg-12'>" +
								 	"<label class='fieldlabels'>Email: *</label>" +
								 	"<input class='form-control' type='email' id='email' form='accountInfoForm' name='email' placeholder='Email' autocomplete='off' required/>" +
								 "</div>" +
								 "<div class='col-lg-12'>" +
								 	"<div class='form-check'>" +
									"<input class='form-check-input' type='checkbox' value='' id='use_pnu_email'>  Use PNU Email Instead" +
									"</div>" +
								 "</div>" +
								 "<div class='col-lg-12'>" +
								 	"<label class='fieldlabels'>Password: *</label>" +
								 	"<input class='form-control' type='password' id='password' form='accountInfoForm' name='password' placeholder='Password' autocomplete='off' required/>" +
								 "</div>" +
								 "<div class='col-md-12'>" +
								 	"<label class='fieldlabels'>Confirm Password: *</label>" +
								 	"<input class='form-control' type='password' id='confirm_password' form='accountInfoForm' name='confirm_password' placeholder='Confirm Password' autocomplete='off' required/>" +
								 "</div>";
			$("#account_inputs").append(account_inputs);
		}
		
	});

	$(document).on('click', '#use_pnu_email', function (e) 
	{
		if($("#use_pnu_email").is(':checked'))
		{
			$("#email").val("Use PNU Email instead");
			$("#email").attr("readonly", "true");
		}
		else
		{
			$("#email").removeAttr("readonly");
			$("#email").val("");
		}  
    });

	$(".next").click(function(){
		var currentFieldSet = $(this).closest("fieldset").attr("id");
		var client_type = $("#client_type").val();

		if(currentFieldSet == "accountInformation")
		{
			if($("#accountInfoForm")[0].checkValidity())
			{
				if($("#password").val() == $("#confirm_password").val())
				{
					if(client_type == "Student")
					{
						var getstudNo = $("#studNo").val();
						var getlastname = $("#lastname").val();
						var getemail = $("#email").val();
						
						if(checkstudent(getstudNo, getlastname, getemail) == "successful")
						{
							current_fs = $(this).parent();
							next_fs = $(this).parent().next();

							//Add Class Active
							$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

							//show the next fieldset
							next_fs.show();
							//hide the current fieldset with style
							current_fs.animate({opacity: 0}, {
							step: function(now) {
							// for making fielset appear animation
							opacity = 1 - now;

							current_fs.css({
							'display': 'none',
							'position': 'relative'
							});
							next_fs.css({'opacity': opacity});
							},
							duration: 500
							});
							setProgressBar(++current);
						}
						else
						{
							alert(checkstudent(getstudNo, getlastname, getemail));
						}
					}
					
				}
				else
				{
					alert("Passwords do not match!");
				}
				
			}
			else
			{
				$("#accountInfoForm")[0].reportValidity();
			}
		}
	});

	function checkstudent(studNo, lastname, email)
	{
		var status;
		$.ajax({
			type: 'POST',
			async: false,
			url: 'checkstudent.php',
			data: {studNo: studNo, lastname: lastname, email: email},
			dataType: 'json',
			success: function(data){
				if(!$.trim(data) == "")
				{
					status = "successful";
				}
				else
				{
					status = "Your student data cannot be found!";
				}
			}
		});
		return status;
	}

	$(".previous").click(function(){

	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();

	//Remove class active
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

	//show the previous fieldset
	previous_fs.show();

	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
	step: function(now) {
	// for making fielset appear animation
	opacity = 1 - now;

	current_fs.css({
	'display': 'none',
	'position': 'relative'
	});
	previous_fs.css({'opacity': opacity});
	},
	duration: 500
	});
	setProgressBar(--current);
	});

	function setProgressBar(curStep){
	var percent = parseFloat(100 / steps) * curStep;
	percent = percent.toFixed();
	$(".progress-bar")
	.css("width",percent+"%")
	}

	$(".submit").click(function(){
	return false;
	});

});
</script>