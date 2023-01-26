<?php
final class AllrecipesController
{
    public function defaultAction() : void{
        View::show("/recipe/recipes", Recipe::selectAll());
    }
}