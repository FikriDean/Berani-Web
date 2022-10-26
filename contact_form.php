<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

date_default_timezone_set('Asia/Jakarta');
function tgl_indo($tanggal)
{
  $bulan = array(
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);

  return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

$mail_to  = $_ENV['EMAIL_USERNAME_TO_BERANI_ID'];



$name     = $_POST['name'];
$email    = $_POST['email'];
$phone    = $_POST['phone'];
$messages  = $_POST['message'];


$message  = "<html><body>";

$message .= "<table width='100%' bgcolor='#000' cellpadding='0' cellspacing='0' border='0'>";

$message .= "<tr><td>";


$message .= "
      <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:wght@700&family=Roboto&family=Saira+Stencil+One&text=Nafie&display=swap'>
      <link rel='stylesheet' href='styles/bootstrap.css'>
      <link rel='stylesheet' href='styles/main.css'>
      <link rel='stylesheet' href='styles/email.css'>
      <link rel='stylesheet' href='styles/libraries.min.css'>
      <div style='background-color:#e32636; border-bottom:solid 1px #bdbdbd; font-family:Saira Stencil One, sans-serif; color:#fff; font-size:34px; text-align: center;height:80px; padding-top:15px' >
        <img src='/assets/favicon.ico' width='30px'>  Berani Digital ID
      </div>";
$message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:80%; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";

$message .= "<tbody>
       <tr>
       <td colspan='4' style='padding:15px;'>
       <hr />
       <p style='font-size:25px; font-family:Roboto, sans-serif;'><span style='font-size:15px'>" . tgl_indo(date('Y-m-d')) . "</span>


       <div>

          <label for='name'>
          <input type='text' disabled value='$name'>
          </label>

          <label for='email'>
          <input type='text' disabled value='$email'>
          </label>
          

          <label for='phone'>
          <input type='text' disabled value='$phone'>
          </label>
          

          <label for='messages'>
            <textarea cols='80' rows='10' disabled>$messages</textarea>
          </label>


       </div>


       </p>
       <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>.</p>
       </td>
       </tr>
      
       <tr height='80'>
       <td colspan='4' align='center' style='background-color:#f5f5f5; border-top:dashed #00a2d1 2px; font-size:24px; '>
       <div class='social'>
          <div class='row'>
            <div class='col-md-6 '>
              <h5>
          Address:
        </h5>
        <p style='font-size:14px'>
          Berani Space Lt. 2, Jl. Diklat Pemda Aryana Blok D9 No. 32, Suka Bakti, Curug, Tangerang, Banten, 15810
        </p>
                
            </div>
            <div class='col-md-6 '>
              <a href='https://www.linkedin.com/company/beranidigital/' target='_blank' rel='noreferrer' >
                  <i class='fa fa-linkedin' aria-hidden='true'></i>
                </a>
                <a href='https://twitter.com/beranidigital?s=20&t=0xPPoeUF2DceQ2WtAJF7iA' target='_blank' rel='noreferrer'>
                  <i class='fa fa-twitter' aria-hidden='true'></i>
                </a>
            </div>
          </div>
          </div>
              </label>
       </td>
       </tr>
      
              </tbody>";

$message .= "</table>";

$message .= "</td></tr>";
$message .= "</table>";

$message .= "</body></html>";


var_dump($message);

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  //Server settings
  $mail->SMTPDebug = 2;
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
  $mail->Body    = $message;

  $mail->send();
  echo 'success';
} catch (Exception $e) {
  echo "error: {$mail->ErrorInfo}";
}
