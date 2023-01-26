<?php

final class SearchRecipesController
{
    public function defaultAction(Array $A_parametres = null, Array $A_postParams = null) : void{
        $A_result = Recipe::searchRecipe($A_postParams);
        if (sizeof($A_result)!=0){
            View::show("recipe/recipes", $A_result);
        }else{
            View::show("recipe/noRecipe");
        }
    }
}


