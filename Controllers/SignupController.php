<?php

/**
 * Class SignupController
 *
 * This class is used to manage the user signup process
 */
final class SignupController
{
    /**
     * Shows the signup form
     *
     * @return void
     */
    public function defaultAction() :void{
        View::show("signup/form");
    }

    /**
     * Handles the user signup request
     *
     * @param Array $A_parametres [optional] contains the parameters needed for the request
     * @param Array $A_postParams [optional] contains the post parameters of the request
     *
     * @return void
     */
    public function createAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        $A_postParams['picture'] = Users::uploadUserPicture($A_postParams['name']);
        $A_postParams['password'] = hash('sha512', $A_postParams['password']);
        if(Users::create($A_postParams)) {
            Session::start('user', $A_postParams['id']);
            header('Location: /home');
            exit;
        }
        header('Location: /signin');
    }
}