<?php

final class UserController
{
    public function defaultAction() {
        View::show("errors/error404");
    }

    public function createAction($A_postParams) {
        View::show("status", User::create($A_postParams));
    }

    public function deleteAction($A_postParams) {
        View::show("status", User::deleteById($A_postParams['id']));
    }

    public function updateAction($A_postParams) {
        View::show("status", User::update($A_postParams));
    }

    public function connectionAction($A_postParams) {
        View::show("status", User::connection($A_postParams));
    }
}