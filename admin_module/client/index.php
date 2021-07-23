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
    	<p class="login-box-msg">E-Services Portal</p>

    	<form action="login.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Input Email Address" required autofocus>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Input Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
      			<div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
				<i> First time to request? Fill up form <a href="register.php">here</a></i>
				<br>
				<i> Forgotten your password? Click <a href="register.php">here</a></i>
        		</div>
      		</div>
    	</form>
  	</div>
  	<?php
  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
  			//unset($_SESSION['error']);
  		}
  	?>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>