<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once($_SERVER['DOCUMENT_ROOT']/PHPMailer/src/Exception.php');

print_r('intra aic');
die();


$_POST = json_decode(file_get_contents('php://input'), true);
if ($_POST['action']) {
    $to = ($_POST['to']) ? $_POST['to'] : '';
    $subject = ($_POST['subject']) ? $_POST['subject'] : '';
    $body = ($_POST['body']) ? $_POST['body'] : '';
    sendEMail($to, $subject, $body);
}



function sendEmail($to, $subject, $body)
{

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'zlatea.alexandra@gmail.com';                 // SMTP username
        $mail->Password = 'mlacif12';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress($to);     // Add a recipient


        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        echo 1;
    } catch (Exception $e) {
        echo 0;
    }
}
