<?php

final class RecipeController
{
    public function showAction(Array $A_parametres = null) {
        if($A_parametres == null || Recipe::selectById($A_parametres[0]) == null) {
            header("Location: /errors/error404");
            exit();
        }
        $A_appreciation = Appreciation::selectByRecipeId($A_parametres[0]);
        for ($i = 0; $i < count($A_appreciation); $i++) {
            $A_appreciation[$i]['user_id'] = Users::selectById($A_appreciation[$i]['user_id'])['name'];
        }
        View::show("/recipe/recipe", array(
            'recipe' => Recipe::selectById($A_parametres[0]),
            'ingredients' => Ingredients::selectAllByRecipeId($A_parametres[0]),
            'utensils' => Utensils::selectAllByRecipeId($A_parametres[0]),
            'appreciation' => $appreciation));
            'isUser' => Session::check()));
    }

    public static function uploadappreciationAction(Array $A_parametres = null, Array $A_postParams = null) {
        if(Session::check()) {
            Appreciation::create($A_postParams);
            header('Location: /recipe/show/' . $A_postParams['recipe_id']);
            exit;
        }
        header('Location: /signin');
        exit;
    }
}