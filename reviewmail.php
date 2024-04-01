<?php
    require "vendor/autoload.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'credentials.php';

function approve_leave_mail($staffName,$hodName,$email,$status) {

    $mail = new PHPMailer(true);

    //$mail->SMTPDebug = 4;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'senator.websitewelcome.com';  // Specify main and backup SMTP servers
        $mail->Port = 465;                                    // TCP port to connect to
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = "alerts@web.bhorukaextrusions.com";                 // SMTP username
        $mail->Password = "Init1298&%Ykk";                           // SMTP password

    // $mail->isSMTP();                                      // Set mailer to use SMTP
    // $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    // $mail->SMTPAuth = true;                               // Enable SMTP authentication
    // $mail->Username = EMAIL;                 // SMTP username
    // $mail->Password = PASS;                           // SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                           // Enable TLS encryption, `ssl` also accepted
    // $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom(EMAIL, 'Leave Application');
    $mail->addAddress($email);              // Name is optional
    $mail->addReplyTo(EMAIL);
    
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = "Leave Application ".$status."";
    $mail->Body    = "<p>Hi <b>".$staffName."</b>,<br><br>
        Your leave application has been <b>".$status."</b> by ".$hodName."<br><br>
        Kindly login into the Leave Application Portal <a href='http://bepl/Leave-System-main/index.php'>(click here)</a> to review.<br><br>
    THANK YOU.<br><br></p>
    <p style='color: red;'>Note: This is a system-generated email. Please do not reply to this email.</p>";
    $mail->AltBody = 'Leave Application from the Leave Management system';
     

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo "<script>alert('Leave Application was successful.');</script>";
    }
 }
?>