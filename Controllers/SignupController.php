<?php

final class SignupController
{
    public function defaultAction() {
        View::show("signup/form");
    }

    public function updateAction(Array $A_parametres = null, Array $A_postParams = null) {
        $A_postParams['picture'] = Users::uploadUserPicture($A_postParams['name']);
        if(Users::create($A_postParams)) {
            Session::start('user', $A_postParams['id']);
            header('Location: /home');
        }
        header('Location: /signin');
    }
}