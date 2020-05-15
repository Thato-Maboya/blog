<?php

require_once 'vendor/autoload.php';

require_once 'app/database/connect.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
    ->setUsername(EMAIL)
    ->setPassword(PASSWORD);

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);


function sendVerificationEmail($userEmail, $token){
    global $mailer;

    $body = "Thank you for signing up on our blog. Please click on the link below to verify your email."."
   <br>"."<br><a href=http://localhost:8080/dashboard/BLOG2/login.php?verification_id=".$token.">Verify your email</a>";

    // Create a message
    $message = (new Swift_Message('Verify your email address'))
        ->setFrom(EMAIL)
        ->setTo($userEmail)
        ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);
}


function sendPasswordResetLink($userEmail, $id){
    global $mailer;

    $body = "Hello there,"."<br>"."<br><a href=http://localhost:8080/dashboard/BLOG2/reset-password.php?reset-password-id=".$id.">Reset your password.</a>";

    // Create a message
    $message = (new Swift_Message('Reset your password'))
        ->setFrom(EMAIL)
        ->setTo($userEmail)
        ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);
}