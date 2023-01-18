<?php

final class UserController
{
    public function defaultAction() {
        View::show("errors/error404");
    }

    public function createAction($A_postParams) {
        $A_postParams = Users::uploadPictures($A_postParams);
        View::show("status", Users::create($A_postParams));
    }

    public function deleteAction($A_postParams) {
        View::show("status", Users::deleteById($A_postParams['id']));
    }

    public function updateAction($A_postParams) {
        $A_postParams = Users::uploadPictures($A_postParams);
        View::show("status", Users::update($A_postParams));
    }

    public function connectionAction($A_postParams) {
        View::show("status", Users::connection($A_postParams));
    }
}