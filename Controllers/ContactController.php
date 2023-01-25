<?php

class ContactController
{
    public function defaultAction() {
        View::show("/contact/contact-form");
    }

    public function updateAction(Array $A_parametres = null, Array $A_postParams = null) {
        Mailer::sendMail("findthebreach.noreply@gmail.com",
            array("subject"=>$A_postParams["subject"],
            "body"=>"Contact info of the user : ".$A_postParams["name"]." ".$A_postParams["surname"]." , e-mail : ".$A_postParams["mail"]."\n".$A_postParams["body"]));
        header("Location: /home");
        exit;
    }
}