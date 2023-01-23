<?php

final class SigninController
{
    public function defaultAction() {
        View::show("signin/form");
    }

    public function updateAction(Array $A_parametres = null, Array $A_postParams = null) {
        $status = Users::isUser($A_postParams);
        switch ($status) {
            case 'user' || 'admin':
                Session::start($status, $A_postParams['id']);
                View::show("categories/show");
                break;
            default:
                View::show("signin/form");
        }
    }
}