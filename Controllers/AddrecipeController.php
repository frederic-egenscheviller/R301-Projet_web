<?php

final class AddrecipeController
{
    public function defaultAction() {
        View::show("recipe/add-recipe");
    }

    public function updateAction(Array $A_parametres = null, Array $A_postParams = null) {
        Recipe::uploadRecipePicture($A_postParams['recipepicture']);
        unset($A_postParams['recipepicture']);
        View::show("recipe/add-recipe", Recipe::create($A_postParams));
    }
}