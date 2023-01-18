<?php

final class HomeController
{
    public function defaultAction($A_postParams): void
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
            'type_cooking' => Recipe::selectCookingTypes(),
            'difficulty' => Recipe::selectDifficulty(),
            'cost' => Recipe::selectCosts(),
            'particularities' => Recipe::selectParticularities()));
    }

    private function randomRecipe() :void
    {
        View::show("recipe/show-three-recipes", Recipe::randomRecipe());
    }
}