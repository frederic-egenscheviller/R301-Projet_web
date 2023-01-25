<?php

final class UpdaterecipeController
{
    public function defaultAction(Array $A_parametres = null, Array $A_postParams = null) {
        View::show("recipe/manage-recipe",
            array(
                'isUpdate' => true,
                'recipe' => Recipe::selectById(1),
                'ingredients' => Ingredients::selectAllByRecipeId(1),
                'utensils' => Utensils::selectAllByRecipeId(1),
                'particularities' => Particularities::selectAllByRecipeId(1)));
    }
}
