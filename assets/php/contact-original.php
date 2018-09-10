<?php
	
$email = "";
$name = "";
$subject = "";
$message = "";

if(isset($_POST['email']))
{
	$email = $_POST['email'];
}

if(isset($_POST['name']))
{
	$name = $_POST['name'];
}

if(isset($_POST['subject']))
{
	$subject = $_POST['subject'];
}

if(isset($_POST['message']))
{
	$message = $_POST['message'];
}


$msg = "";

$msg .= "<p>Email: $email</p>";
$msg .= "<p>Name: $name</p>";
$msg .= "<p>Subject: $subject</p>";
$msg .= "<p>Message:". wordwrap($message, 70)."</p>";


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: admin@zfriedman.com' . "\r\n";

$to = "z.friedman311@gmail.com";
$subject = "New Message from Website";

if(mail($to,$subject,$msg, $headers)){
	//if mail sends, it will redirect to this site
	header("Location: ../../success.html");	
} else {
	header("Location: ../../error.html");	
}

?>