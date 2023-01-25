<?php

class Retrieve_Pwd extends Model
{
    public static function generateToken() : int{
        $I_token = rand(1000, 9999);
        return $I_token;
    }

    public static function sendMail(Array $A_postParams) : void {
       Mailer::sendMail($A_postParams["id"],array("subject"=>"Récupération de mot de passe","body"=>"Votre Token de récupération :\n ".strval($A_postParams["token"])));
    }
}