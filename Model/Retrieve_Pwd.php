<?php

/**
 * Class Retrieve_Pwd
 *
 * This class represents the Retrieve_Pwd table in the DB and communicates with it
 */
class Retrieve_Pwd extends Model
{
    /**
     * Generates a token
     *
     * @return int Generates a random token
     */
    public static function generateToken() : int{
        $I_token = rand(1000, 9999);
        return $I_token;
    }

    /**
     * Send an e-mail
     *
     * @param Array $A_postParams contains the post parameters of the request
     * @return void
     */
    public static function sendMail(Array $A_postParams) : void {
       Mailer::sendMail($A_postParams["id"],array("subject"=>"Récupération de mot de passe","body"=>"Votre Token de récupération :\n ".strval($A_postParams["token"])));
    }
}