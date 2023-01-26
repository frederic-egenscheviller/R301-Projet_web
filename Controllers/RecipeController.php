<?php

final class RecipeController
{
    public function showAction(Array $A_parametres = null) : void{
        if($A_parametres == null || Recipe::selectById($A_parametres[0]) == null) {
            header("Location: /errors/error404");
            exit();
        }
        $A_appreciation = Appreciation::selectAllByRecipeId($A_parametres[0]);
        for ($I_numAppreciation = 0; $I_numAppreciation < count($A_appreciation); $I_numAppreciation++) {
            $A_appreciation[$I_numAppreciation]['id'] = Users::selectById($A_appreciation[$I_numAppreciation]['user_id'])['name'];
            $A_appreciation[$I_numAppreciation]['user_id'] = Users::selectById($A_appreciation[$I_numAppreciation]['user_id'])['user_id'];
        }

        $A_recipe = Recipe::selectById($A_parametres[0]);
        $A_session = Session::getSession();
        View::show("/recipe/recipe", array(
            'recipe' => $A_recipe,
            'ingredients' => Ingredients::selectAllByRecipeId($A_parametres[0]),
            'utensils' => Utensils::selectAllByRecipeId($A_parametres[0]),
            'particularities' => Particularities::selectAllByRecipeId($A_parametres[0]),
            'isOwner' => (($A_session != null) && ($A_session['id'] == $A_recipe['user_id']))
        ));

        if(Session::check()){
            View::show("/recipe/recipe-add-appreciation", array(
                'recipe' => $A_recipe
            ));
        }

        View::show("/recipe/recipe-appreciations", array(
            'appreciation' => $A_appreciation
        ));
    }

    public function editappreciationAction(Array $A_parametres = null) : void{
        if(($A_parametres == null) || (Recipe::selectById($A_parametres[0]) == null) || (Session::getSession()['id'] != (Appreciation::selectById($A_parametres[1])['user_id']))) {
            header("Location: /errors/error404");
            exit();
        }

        $A_recipe = Recipe::selectById($A_parametres[0]);
        View::show("/recipe/recipe", array(
            'recipe' => $A_recipe,
            'ingredients' => Ingredients::selectAllByRecipeId($A_parametres[0]),
            'utensils' => Utensils::selectAllByRecipeId($A_parametres[0]),
            'particularities' => Particularities::selectAllByRecipeId($A_parametres[0]),
        ));

        View::show("recipe/recipe-update-appreciation", array(
            'recipe' => $A_recipe,
            'appreciation' => Appreciation::selectById($A_parametres[1])
        ));
    }

    public function updateappreciationAction(Array $A_parametres = null, Array $A_postParams = null): void {
        Appreciation::updateById($A_postParams,$A_postParams["id"]);
        header('Location: /recipe/show/' . $A_postParams['recipe_id']);
    }

    public static function uploadappreciationAction(Array $A_parametres = null, Array $A_postParams = null):void {
        if(Session::check()) {
            Appreciation::create($A_postParams);
            header('Location: /recipe/show/' . $A_postParams['recipe_id']);
            exit;
        }
        header('Location: /signin');
        exit;
    }
}