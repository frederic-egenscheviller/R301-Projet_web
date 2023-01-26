<?php

final class RecipeController
{
    public function showAction(Array $A_parametres = null) {
        if($A_parametres == null || Recipe::selectById($A_parametres[0]) == null) {
            header("Location: /errors/error404");
            exit();
        }
        $A_appreciation = Appreciation::selectAllByRecipeId($A_parametres[0]);
        for ($i = 0; $i < count($A_appreciation); $i++) {
            $A_appreciation[$i]['id'] = Users::selectById($A_appreciation[$i]['user_id'])['name'];
            $A_appreciation[$i]['user_id'] = Users::selectById($A_appreciation[$i]['user_id'])['user_id'];
        }

        $recipe = Recipe::selectById($A_parametres[0]);
        View::show("/recipe/recipe", array(
            'recipe' => $recipe,
            'ingredients' => Ingredients::selectAllByRecipeId($A_parametres[0]),
            'utensils' => Utensils::selectAllByRecipeId($A_parametres[0]),
            'particularities' => Particularities::selectAllByRecipeId($A_parametres[0]),
        ));

        if(Session::check()){
            View::show("/recipe/recipe-add-appreciation", array(
                'recipe' => $recipe
            ));
        }

        View::show("/recipe/recipe-appreciations", array(
            'appreciation' => $A_appreciation
        ));
    }

    public function editappreciationAction(Array $A_parametres = null) {
        if(($A_parametres == null) || (Recipe::selectById($A_parametres[0]) == null) || (Session::getSession()['id'] != (Appreciation::selectById($A_parametres[1])['user_id']))) {
            header("Location: /errors/error404");
            exit();
        }

        $recipe = Recipe::selectById($A_parametres[0]);
        View::show("/recipe/recipe", array(
            'recipe' => $recipe,
            'ingredients' => Ingredients::selectAllByRecipeId($A_parametres[0]),
            'utensils' => Utensils::selectAllByRecipeId($A_parametres[0]),
            'particularities' => Particularities::selectAllByRecipeId($A_parametres[0]),
        ));

        View::show("recipe/recipe-update-appreciation", array(
            'recipe' => $recipe,
            'appreciation' => Appreciation::selectById($A_parametres[1])
        ));
    }

    public function updateappreciationAction(Array $A_parametres = null, Array $A_postParams = null) {
        Appreciation::updateById($A_postParams,$A_postParams["id"]);
        header('Location: /recipe/show/' . $A_postParams['recipe_id']);
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