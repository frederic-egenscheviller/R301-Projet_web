<?php

final class AppreciationController
{
    public function defaultAction() {
        View::show("errors/error404");
    }

    public static function uploadAction(Array $A_parametres = null, Array $A_postParams = null) {
        if(Session::check()) {
            Appreciation::create($A_postParams);
            header('Location: /recipe/show/' . $A_postParams['recipe_id']);
        } else {
            header('Location: /user/signin');
        }
    }

    public function createAction($A_postParams) {
        View::show("status", Appreciation::create($A_postParams));
    }

    public function editAction($A_postParams) {
        $this -> formAction();
        View::show("appreciation/show", Appreciation::selectById($A_postParams['id']));
    }

    public function deleteAction($A_postParams) {
        View::show("status", Appreciation::deleteById($A_postParams['id']));
    }

    public function formAction() {
        View::show("appreciation/form");
    }

    public function updateAction($A_postParams) {
        View::show("appreciation/form", Ustensil::update($A_postParams));
    }
}