<?php

final class RecipeController
{
    public function defaultAction($A_postParams) {
        if($A_postParams['id'] == null) {
            View::show("errors/error404");
            exit();
        }
        View::show("recipe/recipe", Recipe::selectById($A_postParams['id']));
    }

    public function formAction() {
        View::show("recipe/add-form");
    }

    public function createAction($A_postParams) {
        $A_postParams = Recipe::uploadPictures($A_postParams);
        View::show("status", Recipe::create($A_postParams));
    }

    public function deleteAction($A_postParams) {
        View::show("status", Recipe::deleteById($A_postParams['id']));
    }

    public function updateAction($A_postParams) {
        $A_postParams = Recipe::uploadPictures($A_postParams);
        View::show("status", Recipe::update($A_postParams));
    }

    public function editAction($A_postParams) {
        View::show("recipe/form", Recipe::selectById($A_postParams['id']));
    }

    public function randomRecipeAction() {
        View::show("recipe/show-three-recipes", Recipe::randomRecipe());
    }
}