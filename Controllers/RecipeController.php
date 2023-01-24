<?php

final class RecipeController
{
    public function showAction(Array $A_parametres = null) {
        if($A_parametres == null || Recipe::selectById($A_parametres[0]) == null) {
            header("Location: ../../errors/error404");
            exit();
        }
        $this -> getRecipeCard($A_parametres);
        $this -> getIngredients($A_parametres);
    }

    public function getRecipeCard(Array $A_parametres) {
        View::show("recipe/recipe", Recipe::selectById($A_parametres[0]));
    }

    public function getIngredients(Array $A_parametres) {
        View::show("recipe/ingredients", Ingredients::selectByRecipeId($A_parametres[0]));
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