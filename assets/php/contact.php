<?php

require('autoload.php');
	
// function post_captcha($user_response) {
//     $fields_string = '';
//     $fields = array(
//         'secret' => '6Lc0Sx0UAAAAADBv-ToeZOgdhHUhxwOLYrkAUXel',
//         'response' => $user_response
//     );
//     foreach($fields as $key=>$value)
//     $fields_string .= $key . '=' . $value . '&';
//     $fields_string = rtrim($fields_string, '&');

//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
//     curl_setopt($ch, CURLOPT_POST, count($fields));
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

//     $result = curl_exec($ch);
//     curl_close($ch);

//     return json_decode($result, true);
// }

// // Call the function post_captcha
// $res = post_captcha($_POST['g-recaptcha-response']);

$recaptcha = new \ReCaptcha\ReCaptcha('6Lc0Sx0UAAAAADBv-ToeZOgdhHUhxwOLYrkAUXel');
$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

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

if($resp->isSuccess() && mail($to,$subject,$msg, $headers)){
    //if mail sends, it will redirect to this site
    header("Location: ../../success.html"); 
} else {
    header("Location: ../../error.html");   
}
?>