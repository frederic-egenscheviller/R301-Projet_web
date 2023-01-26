<?php

class ContactController
{
    public function defaultAction() : void{
        View::show("/contact/contact-form");
    }

    public function updateAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Mailer::sendMail("LeGato.official.noreply@gmail.com",
            array("subject"=>$A_postParams["subject"],
            "body"=>"Contact info of the user : ".$A_postParams["name"]." ".$A_postParams["surname"]." , e-mail : ".$A_postParams["mail"]."\n".$A_postParams["body"]));
        header("Location: /home");
        exit;
    }
}