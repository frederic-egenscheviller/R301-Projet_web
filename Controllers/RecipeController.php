<?php

final class RecipeController
{
    public function showAction(Array $A_parametres = null) {
        if($A_parametres == null || Recipe::selectById($A_parametres[0]) == null) {
            header("Location: ../../errors/error404");
            exit();
        }
        $appreciation = Appreciation::selectByRecipeId($A_parametres[0]);
        for ($i = 0; $i < count($appreciation); $i++) {
            $appreciation[$i]['user_id'] = Users::selectById($appreciation[$i]['user_id'])['name'];
        }
        View::show("recipe/recipe", array(
            'recipe' => Recipe::selectById($A_parametres[0]),
            'ingredients' => Ingredients::selectByRecipeId($A_parametres[0]),
            'utensils' => Utensils::selectByRecipeId($A_parametres[0]),
            'appreciation' => $appreciation,
            'isUser' => Session::check()));
    }
}