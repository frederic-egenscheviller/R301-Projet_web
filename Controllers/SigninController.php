<?php

/**
 * SigninController
 *
 * This class is responsible for handling user signin
 */
final class SigninController
{
    /**
     * defaultAction
     *
     * Show signin form
     *
     * @return void
     */
    public function defaultAction() : void{
        View::show("signin/form");
    }

    /**
     * updateAction
     *
     * Update user login
     *
     * @param Array $A_parametres
     * @param Array $A_postParams
     *
     * @return void
     */
    public function updateAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        $S_status = Users::isUser($A_postParams);

        switch ($S_status) {
            case 'user':
            case 'admin':
                Session::start($S_status, $A_postParams['id']);
                Users::updateLastLogin($A_postParams['id']);
                header('Location: /home');
                break;
            default:
                header("Location: /signin");
        }
    }
}