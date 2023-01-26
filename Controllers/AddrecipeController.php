<?php

final class AddrecipeController
{
    public function defaultAction() {
        if(!Session::check()) {
            header('Location: /signin');
            exit;
        }
        View::show("/recipe/add-recipe");
    }

    public function updateAction(Array $A_parametres = null, Array $A_postParams = null) {
        $A_postParams['picture'] = Recipe::uploadRecipePicture($A_postParams['name']);
        View::show("/recipe/add-recipe", array('message' => Recipe::createRecipe($A_postParams)));
    }
}