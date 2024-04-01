<?php
session_start();
include('includes/config.php');

 if(isset($_POST['change']))
{   
    $email = $_POST['email'];
	$emp_id = $_POST['emp_id'];
    $newpassword=md5($_POST['newpassword']);
	$confirmpassword=md5($_POST['confirmpassword']);
	
	$query = mysqli_query($conn,"select * from tblemployees where emp_id ='$emp_id' AND EmailId = '$email'");
   
	
	if($query){

    if($confirmpassword == $newpassword){
		$query = mysqli_query($conn,"update tblemployees set password = '$newpassword' where emp_id = '$emp_id'");
		if ($query) {
			 echo "<script>alert('password Changed successfully');</script>";
			 
			 echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
		}
	}
        
	 else{
		echo "<script>alert(' confirm password INCORRECT');</script>";
		echo "<script type='text/javascript'> document.location = 'forgot_pwd.php'; </script>";
	    die(mysqli_error());
   }

	 }
	
	 else{
	
		echo "<script>alert('email id is invalid  or emp id doesn't belong to emailid');</script>";
		echo "<script type='text/javascript'> document.location = 'forgot_pwd.php'; </script>";
	 }
	
		

}


?>

<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Bhoruka Leave Manager</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/BEPL-logo180.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/BEPL-logo32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/BEPL-logo16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.html">
					<img src="vendors/images/BEPL-logo.png" alt="">
				</a>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="vendors/images/ForgotPasswordIcon.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Forgot Password ?</h2>
						</div>
						<form name="signin" method="post">
						
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Email ID" name="email" id="email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy fa fa-envelope-o" aria-hidden="true"></i></span>
								</div>
							</div>
                            <div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Employee ID" name="emp_id" id="emp_id">
								<div class="input-group-append custom">
									<span class="input-group-text"><i  aria-hidden="true"></i></span>
								</div>
							</div>

                            <div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="New password"name="newpassword" id="newpassword">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
                            


							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="Confirm New password"name="confirmpassword" id="confirmpassword">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
									   <input class="btn btn-primary btn-lg btn-block" name="change" id="change" type="submit" value="Change Password">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
</body>
</html>