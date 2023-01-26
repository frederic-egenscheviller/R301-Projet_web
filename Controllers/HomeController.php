<?php

/**
 * Class HomeController
 *
 * This class represents the HomeController
 */
final class HomeController
{
    /**
     * defaultAction
     *
     * This method call the home page/view
     *
     * @return void
     */
    public function defaultAction(): void
    {
        $this->categories();
        $this->randomRecipe();
    }

    /**
     * categories
     *
     * This method shows the categories view
     *
     * @return void
     */
    private function categories() :void
    {
        View::show("categories/show", array(
            'ingredients' =>  Ingredients::selectAll(),
            'utensils' => Utensils::selectAll(),
            'cooking_types' => Recipe::selectCookingTypes(),
            'difficulties' => Recipe::selectDifficulties(),
            'costs' => Recipe::selectCosts(),
            'particularities' => Particularities::selectAll()));
    }

    /**
     * randomRecipe
     *
     * This method shows the three-recipes view
     *
     * @return void
     */
    private function randomRecipe() :void
    {
        View::show("recipe/three-recipes", array('randomRecipes' => Recipe::randomRecipe()));
    }
}