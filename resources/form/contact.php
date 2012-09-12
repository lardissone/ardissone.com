<?php

define("WEBMASTER_EMAIL", 'leandro@ardissone.com'); // your email here (replace youremail@host.com)

error_reporting (E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if($post)
{
include 'functions.php';

$name = stripslashes($_POST['name']);
$email = trim($_POST['email']);
$subject = stripslashes($_POST['subject']);
$message = stripslashes($_POST['message']);


$error = '';

// Check name

if(!$name)
{
$error .= 'Please enter your name.<br />';
}

if(!$subject)
{
$error .= 'Please enter a subject.<br />';
}

// Check email
if(!$email)
{
$error .= 'Please enter a valid e-mail address.<br />';
}

if($email && !ValidateEmail($email))
{
$error .= 'Please enter a valid e-mail address.<br />';
}

// Check message (length)

if(!$message || strlen($message) < 10)
{
$error .= "Please enter your message. At least 10 characters.<br />";
}


if(!$error)
{
$mail = mail(WEBMASTER_EMAIL, $subject, $message,
     "From: ".$name." <".$email.">\r\n"
    ."Reply-To: ".$email."\r\n"
    ."X-Mailer: PHP/" . phpversion());


if($mail)
{
echo 'OK';
}

}
else
{
echo '<div class="notificationError">'.$error.'</div>';
}

}
?>