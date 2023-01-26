<?php

//Les methodes pour charger les 3 classes ont été faites dans la classe AutoLoad et Constants, mais etant donnée qu'elles ne marchent pas on as du utiliser require
require "Core/Phpmailer/PHPMailer.php";
require "Core/Phpmailer/SMTP.php";
require "Core/Phpmailer/Exception.php";

/**
 * Mailer class
 */
class Mailer
{
    /**
     * Send a mail
     *
     * @param string $S_mail The mail adress of the recipient
     * @param Array $S_mailContent An array containing the subject and body of the mail
     * @return void
     */
    public static function sendMail(string $S_mail, Array $S_mailContent) : void {
        //We create an instance of PHPMailer
        $P_sentMail = new \PHPMailer\PHPMailer\PHPMailer();

        //UTF-8 encoding for accents...
        $P_sentMail->CharSet = 'UTF-8';

        //We use the SMTP mail server
        $P_sentMail->isSMTP();

        //We define the SMTP host (in our case GMAIL)
        $P_sentMail->Host = "smtp.gmail.com";

        //We enable SMTP authentication
        $P_sentMail->SMTPAuth = true;

        //We use the tls type encryption (Transport Layer Security)
        $P_sentMail->SMTPSecure = "tls";

        //We connect to port 587 which is a secure port
        $P_sentMail->Port = "587";

        //We give the user, i.e. the login of the GMAIL account
        $P_sentMail->Username = "LeGato.official.noreply@gmail.com";

        //We give the password that was generated in the security part of the GMAIL account
        $P_sentMail->Password = "ryepxreaxmcqvphq";

        //The subject of the email
        $P_sentMail->Subject = $S_mailContent["subject"];

        //The person who sends the email
        $P_sentMail->setFrom("LeGato.official.noreply@gmail.com");

        //We enable the page format (We can use page syntax, i.e. tags in the body of the mail and it will be recognized)
        $P_sentMail->isHTML(true);

        //The body of the mail,
        $P_sentMail->Body = $S_mailContent["body"];

        //We add the email address of the recipient
        $P_sentMail->addAddress($S_mail);

        $P_sentMail->send();

        //We close the SMTP connection to the GMAIL account
        $P_sentMail->smtpClose();
    }
}