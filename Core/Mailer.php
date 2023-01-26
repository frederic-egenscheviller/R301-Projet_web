<?php
//Les methodes pour charger les 3 classes ont été faites dans la classe AutoLoad et Constants, mais etant donnée qu'elles ne marchent pas on as du utiliser require
require "Core/Phpmailer/PHPMailer.php";
require "Core/Phpmailer/SMTP.php";
require "Core/Phpmailer/Exception.php";
class Mailer
{
    public static function sendMail(string $S_mail, Array $S_mailContent) : void {
        //We create an instance of PHPMailer
        $mail = new \PHPMailer\PHPMailer\PHPMailer();

        //UTF-8 encoding for accents...
        $mail->CharSet = 'UTF-8';

        //We use the SMTP mail server
        $mail->isSMTP();

        //We define the SMTP host (in our case GMAIL)
        $mail->Host = "smtp.gmail.com";

        //We enable SMTP authentication
        $mail->SMTPAuth = true;

        //We use the tls type encryption (Transport Layer Security)
        $mail->SMTPSecure = "tls";

        //We connect to port 587 which is a secure port
        $mail->Port = "587";

        //We give the user, i.e. the login of the GMAIL account
        $mail->Username = "LeGato.official.noreply@gmail.com";

        //We give the password that was generated in the security part of the GMAIL account
        $mail->Password = "ryepxreaxmcqvphq";

        //The subject of the email
        $mail->Subject = $S_mailContent["subject"];

        //The person who sends the email
        $mail->setFrom("LeGato.official.noreply@gmail.com");

        //We enable the page format (We can use page syntax, i.e. tags in the body of the mail and it will be recognized)
        $mail->isHTML(true);

        //The body of the mail,
        $mail->Body = $S_mailContent["body"];

        //We add the email address of the recipient
        $mail->addAddress($S_mail);

        $mail->send();

        //We close the SMTP connection to the GMAIL account
        $mail->smtpClose();
    }
}