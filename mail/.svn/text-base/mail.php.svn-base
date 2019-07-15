<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
$from = trim($_REQUEST['from']);
$fromname = trim($_REQUEST['fromname']);
$to = trim($_REQUEST['to']);
$toname = trim($_REQUEST['toname']);
$subject = trim($_REQUEST['subject']);
$body = trim($_REQUEST['body']);
require_once('class.phpmailer.php');


$mail = new PHPMailer(true); 

$mail->IsSMTP(); 

try {
  $mail->Host       = "smtp.gmail.com"; // SMTP server
  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "qucardmail@gmail.com";  // GMAIL username
  $mail->Password   = "qucardmail";            // GMAIL password
  $mail->AddAddress($to, $toname);
  $mail->SetFrom($from, $fromname);
  $mail->Subject = $subject ;
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($body);
  $mail->Send();
  //echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
  //echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  //echo $e->getMessage(); //Boring error messages from anything else!
}
?>
