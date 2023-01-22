<?php

final class HomeController
{
    public function defaultAction(): void
    {
        $this->categories();
        $this->randomRecipe();
    }

    private function categories() :void
    {
        View::show("categories/show", array(
            'ingredients' =>  Ingredients::selectAll(),
            'utensils' => Utensils::selectAll(),
            'cooking_times' => Recipe::selectCookingTimes(),
            'types_cooking' => Recipe::selectCookingTypes(),
            'difficulties' => Recipe::selectDifficulties(),
            'costs' => Recipe::selectCosts(),
            'particularities' => Particularities::selectAll()));
    }

    private function randomRecipe() :void
    {
        View::show("recipe/three-recipes", array('randomRecipes' => Recipe::randomRecipe()));
    }
}