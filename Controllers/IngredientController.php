<?php

final class IngredientController
{
    public function defaultAction($A_postParams) {
        View::show("ingredient/show", Ingredient::select($A_postParams));
    }

    public function createAction($A_postParams) {
        View::show("status", Ingredient::create($A_postParams));
    }

    public function deleteAction($A_postParams) {
        View::show("status", Ingredient::deleteById($A_postParams['id']));
    }

    public function formAction() {
        View::show("ingredient/form");
    }

    public function editAction($A_postParams) {
        $this -> formAction();
        View::show("ingredient/show", Ingredient::selectById($A_postParams['id']));
    }

    public function updateAction($A_postParams) {
        View::show("ingredient/form", Ingredient::update($A_postParams));
    }
}