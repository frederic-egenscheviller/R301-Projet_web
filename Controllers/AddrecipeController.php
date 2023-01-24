<?php

final class AddrecipeController
{
    public function defaultAction() {
        View::show("recipe/add-recipe");
    }

    public function updateAction(Array $A_parametres = null, Array $A_postParams = null) {
        $A_postParams['picture'] = Recipe::uploadRecipePicture($A_postParams['name']);
        Recipe::createRecipe($A_postParams);
    }
}