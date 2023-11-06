<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once("vendor/autoload.php");
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
date_default_timezone_set('Asia/Kolkata');

$name       = @trim(stripslashes($_POST['name']));
$from       = @trim(stripslashes($_POST['email']));
$phone_number    = @trim(stripslashes($_POST['sub']));
$message    = @trim(stripslashes($_POST['message']));

$to = array('vinayaka@kavinsoft.com');

// Function to send an email to the management
function SendEmail($name,$from,$to,$phone_number,$message)
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'in-v3.mailjet.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username = '05fbb639a9ebf981b507e0cbe3be2cab'; //paste one generated by Mailtrap
        $mail->Password = '0257352b70bdcc693cf4a50b7d15400b'; //paste one generated by Mailtrap                               //SMTP password
        $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        //Recipients
        $mail->From = "communication@gctacommunity.org";
        $mail->FromName = "Kavintech";
        //$mail->setFrom(, $FromUsername);
        foreach ($to as $email) {
            $mail->addAddress($email, 'Management');     //Add a recipient
        }
        //$mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        $mail->addReplyTo($from, "Reply");
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image1.jpg', 'new.jpg');    //Optional name
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Subject - Business query from Kavintech website';
        $mail->Body    = "<p><b>Date and Time:</b> ".date('d/m/Y h:i:s a')."</p>";
        $mail->Body    .= "<p><b>Name:</b> {$name}</p>";
        $mail->Body    .= "<p><b>Email Id:</b> {$from}</p>";
        $mail->Body    .= "<p><b>Phone Number:</b> {$phone_number}</p>";
        $mail->Body    .= "<p><b>Message:</b> {$message}</p>";
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        echo "1";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

					 
SendEmail($name,$from,$to,$phone_number,$message);


?>