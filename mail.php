<?php
require 'vendor/autoload.php'; // Include PHPMailer

$mail = new PHPMailer\PHPMailer\PHPMailer();

$mail->isSMTP();
$mail->Host = 'senator.websitewelcome.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username = 'alerts@web.bhorukaextrusions.com';
$mail->Password = 'Init1298&%Ykk';

$mail->setFrom('alerts@web.bhorukaextrusions.com', 'alert');
$mail->addAddress('ramya_s@bhorukaextrusions.com', 'ramya');
$mail->Subject = 'mail test 465';
$mail->Body = 'Content of the Email confirm 465';

if ($mail->send()) {
    echo 'Email has been sent successfully.';
} else {
    echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
}
