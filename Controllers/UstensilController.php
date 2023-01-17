<?php

final class UstensilController
{
    public function defaultAction($A_postParams) {
        View::show("ustensil/show", Ustensil::selectById($A_postParams['id']));
    }

    public function createAction($A_postParams) {
        View::show("status", Ustensil::create($A_postParams));
    }

    public function editAction($A_postParams) {
        $this -> formAction();
        View::show("ustensil/show", Ustensil::selectById($A_postParams['id']));
    }

    public function deleteAction($A_postParams) {
        View::show("status", Ustensil::deleteById($A_postParams['id']));
    }

    public function formAction() {
        View::show("ustensil/form");
    }

    public function updateAction($A_postParams) {
        View::show("ustensil/form", Ustensil::update($A_postParams));
    }
}