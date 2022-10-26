<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


$mail_to  = $_ENV['EMAIL_USERNAME_TO_BERANI_ID'];
var_dump('TEST '.$mail_to);



$name     = $_POST['name'];
$email    = $_POST['email'];
$phone    = $_POST['phone'];
$message  = $_POST['message'];

$body   = "New Message From: " . "$name " . "<$email>" . "\n\n";
$body   .= "----------------" . "\n\n";
$body   .= "Name: " . "$name" . "\n\n";
$body   .= "Email: " . "$email" . "\n\n";
$body   .= "Phone: " . "$phone" . "\n\n";
$body   .= "Message: " . "\n\n" . "$message" . "\n\n";

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  //Server settings
  $mail->SMTPDebug = 1;
  $mail->isSMTP();
  $mail->Host       = $_ENV['EMAIL_HOST_BERANI_ID'];
  $mail->SMTPAuth   = $_ENV['EMAIL_AUTH_BERANI_ID'];
  $mail->Username   = $_ENV['EMAIL_USERNAME_BERANI_ID'];
  $mail->Password   = $_ENV['EMAIL_PASSWORD_BERANI_ID'];
  $mail->SMTPSecure = $_ENV['EMAIL_ENCRYPTION_BERANI_ID'];
  $mail->Port       = $_ENV['EMAIL_PORT_BERANI_ID'];

  //Recipients
  $mail->setFrom($mail_to, $_ENV['EMAIL_NAME_BERANI_ID']);
  $mail->addAddress($mail_to);
  $mail->addCC($email);

  //Content
  $mail->isHTML(true);
  $mail->Subject = 'Kontak email dari ' . $email;
  $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

  $mail->send();
  echo 'success';
} catch (Exception $e) {
  echo "error: {$mail->ErrorInfo}";
}
