<?php

/**
 * Class RetrievepwddirectivesController
 *
 * This class provides methods to give the directives for retrieving password.
 */
class RetrievepwddirectivesController
{
    /**
     * Show view for password retrieval
     *
     * @return void
     */
    public function defaultAction() : void{
        View::show("retrieve_pwd/form-directives");
    }

    /**
     * Send password retrieval details and e-mail
     *
     * @param Array $A_parametres [optional]
     * @param Array $A_postParams [optional]
     *
     * @return void
     */
    public function sendAction(Array $A_parametres = null, Array $A_postParams = null) : void{

        if(!Users::checkIfExistsById($A_postParams["id"])){
            header("Location: /signup");
            exit;
        }

        $I_token = Retrieve_Pwd::generateToken();
        $A_postParams["token"] = $I_token;

        if (Retrieve_Pwd::checkIfExistsById($A_postParams["id"])){
            Retrieve_Pwd::updateById(array("id" => $A_postParams["id"], "token"=>$I_token),$A_postParams["id"]);
        }else{
            Retrieve_Pwd::create($A_postParams);
        }

        Retrieve_Pwd::sendMail($A_postParams);
        header("Location: /retrievepwd");
        exit;
    }
}