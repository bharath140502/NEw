<?php
    require "vendor/autoload.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    // require 'PHPMailer/src/Exception.php';
    // require 'PHPMailer/src/PHPMailer.php';
    // require 'PHPMailer/src/SMTP.php';

    require 'credentials.php';

    function send_mail($name,$from,$email,$to, $type,$hodName) {

        $mail = new PHPMailer(true);

        //$mail->SMTPDebug = 4;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'senator.websitewelcome.com';  // Specify main and backup SMTP servers
        $mail->Port = 465;                                    // TCP port to connect to
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = "alerts@web.bhorukaextrusions.com";                 // SMTP username
        $mail->Password = "Init1298&%Ykk";                           // SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                           // Enable TLS encryption, `ssl` also accepted
       

        $mail->setFrom(EMAIL, 'Leave Application');
        $mail->addAddress($email);              // Name is optional
        $mail->addReplyTo(EMAIL);
        
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = " ".$type." Application";
        $mail->Body    = "
            <p>Hi <b>".$hodName."</b>,<br><br>
            <b>".$name."</b> has applied for ".$type." from ".$from." to ".$to." Kindly login into the Leave Application Portal <a href='http://bepl/Leave-System-main/index.php'>(click here)</a> and review.<br><br>
            THANK YOU.<br><br></p>
            <p style='color: red;'>Note: This is a system-generated email. Please do not reply to this email.</p>";
        $mail->AltBody = 'Leave Application from the Leave Management system';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo "<script>alert('Leave Application was successful.');</script>";
            echo "<script type='text/javascript'> document.location = 'leave_history.php'; </script>";
        }
    }
    // function send_mail2($name, $from, $email, $to, $type, $hodName) {
    //     $mail = new PHPMailer(true);
    
    //     $mail->isSMTP();                                      // Set mailer to use SMTP
    //     $mail->Host = 'senator.websitewelcome.com';  // Specify main and backup SMTP servers
    //     $mail->Port = 465;                                    // TCP port to connect to
    //     $mail->SMTPSecure = 'ssl';
    //     $mail->SMTPAuth = true;                               // Enable SMTP authentication
    //     $mail->Username = "alerts@web.bhorukaextrusions.com";                 // SMTP username
    //     $mail->Password = "Init1298&%Ykk";       // ... (SMTP configuration)
    
    //     $mail->setFrom(EMAIL, 'Leave Application');
    //     $mail->addAddress($email);  // Sending email to the user who applied
    //     $mail->addReplyTo(EMAIL);
    
    //     $mail->isHTML(true);
    
    //     $mail->Subject = "Leave Application";
    //     $mail->Body = "
    //         <p>Hi <b>".$name."</b>,<br><br>
    //         You have successfully applied for ".$type." leave from ".$from." to ".$to.".
    //         Please wait for approval from your manager.<br><br>
    //         THANK YOU.<br><br></p>
    //         <p style='color: red;'>Note: This is a system-generated email. Please do not reply to this email.</p>";
    //     $mail->AltBody = 'Leave Application confirmation from the Leave Management system';
    
    //     if (!$mail->send()) {
    //         echo 'Message could not be sent.';
    //         echo 'Mailer Error: ' . $mail->ErrorInfo;
    //     } else {
    //         echo "<script>alert('Leave Application was successful.');</script>";
    //         echo "<script type='text/javascript'> document.location = 'leave_history.php'; </script>";
    //     }
    // }
    
?>