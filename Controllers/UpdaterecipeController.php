<?php

final class UpdaterecipeController
{
    public function showAction(Array $A_parametres = null, Array $A_postParams = null) {
        $id = $A_parametres[0];
        if(!Recipe::selectById($id)) {
            header('Location: /errors/error404');
        }

        View::show("recipe/update-recipe",
        array(
            'isUpdate' => true,
            'recipe' => Recipe::selectById($id),
            'ingredients' => Ingredients::selectAllByRecipeId($id),
            'utensils' => Utensils::selectAllByRecipeId($id),
            'particularities' => Particularities::selectAllByRecipeId($id)));
    }

    public function updateAction(Array $A_parametres = null, Array $A_postParams = null) {
        $A_postParams['picture'] = Recipe::updateRecipePicture($A_postParams);
        View::show("recipe/add-recipe", array('message' => Recipe::updateRecipe($A_postParams)));
    }
}
