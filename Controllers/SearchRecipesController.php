<?php

final class SearchRecipesController
{
    public function defaultAction(Array $A_parametres = null, Array $A_postParams = null) {
        View::show("recipe/recipes", Recipe::searchRecipe($A_postParams));
    }
}


