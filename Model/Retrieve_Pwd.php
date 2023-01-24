<?php
//require "Core/Phpmailer/PHPMailer.php";
class Retrieve_Pwd extends Model
{
    public static function generateToken() : int{
        $I_token = rand(1000, 9999);
        return $I_token;
    }

    public static function sendMail(Array $A_postParams) : void {
        // On crée uns instance de PHPMailer
        $mail = new \PHPMailer\PHPMailer\PHPMailer();

        // Encodage UTF-8 pour les accents...
        $mail->CharSet = 'UTF-8';

        // On utilise le serveur mail SMTP
        $mail->isSMTP();

        // On définit l'hôte smtp (dans notre cas GMAIL)
        $mail->Host = "smtp.gmail.com";

        // On active l'authentification SMTP
        $mail->SMTPAuth = true;

        // On utilise l'encryptage de type tls (Transport Layer Security)
        $mail->SMTPSecure = "tls";

        // On se connecte sur le port 587 qui est un port sécurité
        $mail->Port = "587";

        // On donne l'utilisateur à savoir le login du compte GMAIL
        $mail->Username = "findthebreach.noreply@gmail.com";

        // On donne le mot de passe qui à été généré dans la partie sécurité du compte GMAIL
        $mail->Password = "bpghsngrhhjqnznl";

        // Le sujet de l'email
        $mail->Subject = "Récupération de mot de passe ";

        // La personne qui envoie l'email
        $mail->setFrom("findthebreach.noreply@gmail.com");

        // On active le format pages (On peu utiliser la synthaxe pages a savoir les balises dans le corps du mail et celui-ci sera reconnu)
        $mail->isHTML(true);

        // Le corps du mail a savoir le token qui est généré aléatoirement
        $mail->Body = "Votre Token de récupération :\n ".strval($A_postParams["token"]);

        // On ajoute l'adresse mail du destinataire
        $mail->addAddress($A_postParams["id"]);

        // On ferme la connexion SMTP au compte GMAIL
        $mail->smtpClose();
    }
}