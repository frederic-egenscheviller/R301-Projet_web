<?php

final class RecipeController
{
    public function showAction(Array $A_parametres = null) {
        if($A_parametres == null || Recipe::selectById($A_parametres[0]) == null) {
            header("Location: ../../errors/error404");
            exit();
        }
        View::show("recipe/recipe", array(
            'recipe' => Recipe::selectById($A_parametres[0]),
            'ingredients' => Ingredients::selectByRecipeId($A_parametres[0])));
    }
}