<?php

/**
 * SearchRecipesController final class
 */
final class SearchRecipesController
{
    /**
     * Show the recipes from the search
     *
     * @param array|null $A_parametres Input parameters
     * @param array|null $A_postParams Post parameters
     *
     * @return void
     */
    public function defaultAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        $A_result = Recipe::searchRecipe($A_postParams);
        if (sizeof($A_result)!=0){
            View::show("recipe/recipes", $A_result);
        }else{
            View::show("recipe/noRecipe");
        }
    }
}


