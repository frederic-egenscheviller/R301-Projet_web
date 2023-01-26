<?php
/**
 * Class AllrecipesController
 *
 * A class that shows all recipes
 */
final class AllrecipesController
{
    /**
     * Shows all the recipes
     *
     * @return void
     */
    public function defaultAction() : void{
        View::show("/recipe/recipes", Recipe::selectAll());
    }
}