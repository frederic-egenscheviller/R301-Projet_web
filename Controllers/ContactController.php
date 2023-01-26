<?php

/**
 * ContactController class
 */
class ContactController
{
    /**
     * defaultAction method
     *
     * This method shows the contact-form view
     *
     * @return void
     */
    public function defaultAction() : void{
        View::show("/contact/contact-form");
    }

    /**
     * updateAction method
     *
     * This method send a mail with the contact info of the user
     *
     * @param Array $A_parametres contains the parameters of the request
     * @param Array $A_postParams contains the post parameters of the request
     *
     * @return void
     */
    public function updateAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        Mailer::sendMail("LeGato.official.noreply@gmail.com",
            array("subject"=>$A_postParams["subject"],
                "body"=>"Contact info of the user : ".$A_postParams["name"]." ".$A_postParams["surname"]." , e-mail : ".$A_postParams["mail"]."\n".$A_postParams["body"]));
        header("Location: /home");
        exit;
    }
}