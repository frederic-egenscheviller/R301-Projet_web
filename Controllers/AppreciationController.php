<?php

final class AppreciationController
{
    public function defaultAction() {
        View::show("errors/error404");
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